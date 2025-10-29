<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\UserModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Api extends BaseController
{
    use ResponseTrait;

    public function test()
    {
        return $this->respond([
            'success' => true,
            'message' => 'API funcionando'
        ], 200);
    }

    public function login()
    {
        $request = $this->request->getJSON(true);

        $email = $request['email'] ?? null;
        $password = $request['password'] ?? null;

        if (!$email || !$password) {
            return $this->respond([
                'success' => false,
                'message' => 'Email e senha são obrigatórios.'
            ], 400);
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->respond([
                'success' => false,
                'message' => 'Credenciais inválidas.'
            ], 401);
        }

        // Gera o token JWT
        $issuedAt   = time();
        $expiration = $issuedAt + getenv('JWT_EXPIRATION');
        $payload = [
            'iat' => $issuedAt,
            'exp' => $expiration,
            'uid' => $user['id'],
            'email' => $user['email'],
            'iss' => base_url(),
        ];

        $jwt = JWT::encode($payload, getenv('JWT_SECRET'), 'HS256');

        return $this->respond([
            'success' => true,
            'message' => 'Login realizado com sucesso.',
            'token' => $jwt,
            'user_id' => $user['id']
        ], 200);
    }

    public function userInfo($id)
    {
        $decoded = $this->request->decodedToken ?? null;

        if (!$decoded || !isset($decoded['uid']) || $decoded['uid'] != $id) {
            return $this->response->setStatusCode(401)
                ->setJSON(['error' => 'Token inválido para este usuário.']);
        }

        $db = \Config\Database::connect();

        $feedbacks = $db->table('replies')
            ->select('replies.*, reply_questions.*, forms.name as form_name, forms.hash as form_hash')
            ->join('forms', 'forms.hash = replies.form')
            ->join('reply_questions', 'reply_questions.reply = replies.hash')
            ->where('forms.user', $id)
            ->get()
            ->getResultArray();

        $nps = $this->calculateNPS($feedbacks);
        $csat = $this->calculateCSAT($feedbacks);
        $stars = $this->calculateStars($feedbacks);

        $formsCount = $db->table('forms')->where('user', $id)->countAllResults();

        return $this->response->setJSON([
            'status' => 'ok',
            'user_id' => $id,
            'nps' => $nps['npsScore'],
            'csat' => $csat['csatPercent'],
            'stars' => $stars['media'],
            'forms_count' => $formsCount
        ]);
    }

    private function calculateNPS($feedbacks)
    {
        $promotores = $detratores = $total = 0;
        foreach ($feedbacks as $fb) {
            if (!is_null($fb['nps']) && (int)$fb['nps'] > 0) {
                $nps = (int)$fb['nps'];
                $total++;
                if ($nps >= 9) $promotores++;
                elseif ($nps <= 6) $detratores++;
            }
        }
        $npsScore = $total > 0 ? round((($promotores - $detratores) / $total) * 100) : 0;
        return compact('npsScore');
    }

    private function calculateCSAT($feedbacks)
    {
        $satisfeitos = $total = 0;
        foreach ($feedbacks as $fb) {
            if (!is_null($fb['csat']) && (int)$fb['csat'] > 0) {
                $total++;
                if ((int)$fb['csat'] >= 4) $satisfeitos++;
            }
        }
        $csatPercent = $total > 0 ? round(($satisfeitos / $total) * 100) : 0;
        return compact('csatPercent');
    }

    private function calculateStars($feedbacks)
    {
        $total = $soma = 0;
        foreach ($feedbacks as $fb) {
            if (!is_null($fb['simple_star']) && (int)$fb['simple_star'] > 0) {
                $total++;
                $soma += (int)$fb['simple_star'];
            }
        }
        $media = $total > 0 ? round($soma / $total, 1) : 0;
        return compact('media');
    }

    public function updateUser($id)
    {
        $decoded = $this->request->decodedToken ?? null;

        if (!$decoded || !isset($decoded['uid']) || $decoded['uid'] != $id) {
            return $this->response->setStatusCode(401)
                ->setJSON(['error' => 'Token inválido para este usuário.']);
        }

        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->response->setStatusCode(400)
                ->setJSON(['error' => 'Requisição inválida ou corpo vazio.']);
        }

        $validation = \Config\Services::validation();
        $validationRules = [
            'firstname' => 'required|alpha_space',
            'lastname'  => 'required|alpha_space',
            'email'     => 'required|valid_email|is_unique[users.email,id,' . $id . ']'
        ];
        $validationMessages = [
            'firstname' => [
                'required' => 'O nome é obrigatório.',
                'alpha_space' => 'O nome deve conter apenas letras e espaços.'
            ],
            'lastname' => [
                'required' => 'O sobrenome é obrigatório.',
                'alpha_space' => 'O sobrenome deve conter apenas letras e espaços.'
            ],
            'email' => [
                'required' => 'O email é obrigatório.',
                'valid_email' => 'O email informado não é válido.',
                'is_unique' => 'O email já está em uso por outro usuário.'
            ]
        ];

        if (!$validation->setRules($validationRules, $validationMessages)->run($data)) {
            return $this->response->setStatusCode(422)
                ->setJSON(['errors' => $validation->getErrors()]);
        }

        $userModel = new UserModel();
        $updated = $userModel->update($id, [
            'firstname' => $data['firstname'],
            'lastname'  => $data['lastname'],
            'email'     => $data['email']
        ]);

        if (!$updated) {
            return $this->response->setStatusCode(500)
                ->setJSON(['error' => 'Falha ao atualizar o usuário.']);
        }

        return $this->response->setJSON([
            'status' => 'ok',
            'message' => 'Usuário atualizado com sucesso.'
        ]);
    }

    public function userFeedbacks($id)
    {
        $decoded = $this->request->decodedToken ?? null;

        if (!$decoded || !isset($decoded['uid']) || $decoded['uid'] != $id) {
            return $this->response->setStatusCode(401)
                ->setJSON(['error' => 'Token inválido para este usuário.']);
        }

        $page = (int)($this->request->getGet('page') ?? 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $db = \Config\Database::connect();

        $query = $db->table('replies')
            ->select('forms.name AS form_name, replies.client_name, replies.created_at AS date, replies.hash AS reply_hash, forms.public_link AS form_url')
            ->join('forms', 'forms.hash = replies.form')
            ->where('forms.user', $id)
            ->orderBy('replies.created_at', 'DESC');

        $total = $query->countAllResults(false);

        $feedbacks = $query->limit($limit, $offset)->get()->getResultArray();

        return $this->response->setJSON([
            'status' => 'ok',
            'page' => $page,
            'limit' => $limit,
            'total' => $total,
            'data' => $feedbacks
        ]);
    }

    public function feedbackInfo($feedback_hash)
    {
        $decoded = $this->request->decodedToken ?? null;

        if (!$decoded || !isset($decoded['uid'])) {
            return $this->response->setStatusCode(401)
                ->setJSON(['error' => 'Token inválido.']);
        }

        $uid = $decoded['uid'];

        $db = \Config\Database::connect();

        $query = $db->table('replies')
            ->select('
            reply_questions.nps,
            reply_questions.csat,
            reply_questions.cli,
            reply_questions.ces,
            reply_questions.simple_star,
            reply_questions.exit_survey,
            reply_questions.free_question_1,
            reply_questions.free_question_2
        ')
            ->join('forms', 'forms.hash = replies.form')
            ->join('reply_questions', 'reply_questions.reply = replies.hash')
            ->where('replies.hash', $feedback_hash)
            ->where('forms.user', $uid)
            ->get();

        $result = $query->getRowArray();

        if (!$result) {
            return $this->response->setStatusCode(404)
                ->setJSON(['error' => 'Feedback não encontrado ou não pertence a este usuário.']);
        }

        return $this->response->setJSON([
            'status' => 'ok',
            'data' => $result
        ]);
    }
}

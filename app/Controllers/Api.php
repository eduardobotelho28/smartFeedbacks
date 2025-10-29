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
        return $this->response->setJSON([
            'message' => 'Token válido! Usuário autenticado.',
            'user_id' => $id
        ]);
    }

}

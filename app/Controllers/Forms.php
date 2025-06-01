<?php

namespace App\Controllers;

use App\Models\FormsModel;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class Forms extends BaseController
{

    protected $model;
    protected $replyModel;

    public function __construct()
    {
        $this->model = new FormsModel();
        $this->replyModel = new \App\Models\ReplyModel();
    }

    public function userForms () {
        $user = session()->get('user');
        $data['forms'] = $this->model->where('user', $user)->findAll();
        return view ('userForms/forms', $data);
    }

    public function createFormView () {
        return view ('userForms/create');
    }

    public function create () {

        $data     = $this->request->getPost();
        $add_nps  = $this->request->getPost('add_nps')  ? 1 : 0;
        $add_csat = $this->request->getPost('add_csat') ? 1 : 0;

        $user = session()->get('user');

        $validationRules = [
            'name'          => 'required|min_length[5]'  ,
        ];
        $validationMessages = [
            'name' => [
                'required'  => 'O nome do Formulário é obrigatório.',
                'min_length' => 'O nome do formulário deve conter ao menos 5 caracteres'
            ],
        ];


        if (! $this->validate($validationRules, $validationMessages)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $this->validator->getErrors()
            ]);
        }

        $hash = bin2hex(random_bytes(10));
        $publicLink = site_url("forms/reply/{$hash}");

        // gerar o QR Code
        $qrCodePath = $this->generateQrCodeAndUpload($publicLink);

        $normalize = fn($val) => trim($val) === '' ? null : $val;
        $formData = [
            'user'         => $user                                  ,
            'name'         => htmlspecialchars($data['name'])        ,
            'question_1'   => $normalize($data['question_1'] ?? null),
            'question_2'   => $normalize($data['question_2'] ?? null),
            'question_3'   => $normalize($data['question_3'] ?? null),
            'add_nps'      => $add_nps                               , 
            'add_csat'     => $add_csat                              ,
            'hash'         => $hash                                  ,
            'qr_code_path' => $qrCodePath                            ,               
            'public_link'  => $publicLink                            ,
            'created_at'   => date('Y-m-d H:i:s')                    ,
        ];

        $this->model->insert($formData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Formulário criado com sucesso!'
        ]);

    }

    public function delete ($form_hash) {
        
        $form = $this->model->where('hash', $form_hash)
                            ->where('user', session()->get('user'))
                            ->first();
    
        if(!$form) 
            return redirect()->to('forms');

        $this->model->delete($form['id']);

        session()->setFlashdata('toast_message', [
                'type'    => 'success', 
                'message' => 'Formulário excluído!'
            ]);

        return redirect()->to('forms');

    }

    public function reply_view ($hash) {
    
        $form = $this->model->where('hash', $hash)->first();

        if (!$form) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Formulário não encontrado.");
        }

        return view('publicForms/reply', ['form' => $form]);
    }

    public function reply($formHash) {

        $data = $this->request->getPost();

        // Verifica se o formulário foi enviado com campos obrigatórios
        $camposObrigatorios = [];

        foreach ($data as $key => $value) {
            $value = trim($value);
            
            // Ignora campos opcionais
            if ($key === 'name') {
                continue;
            }

            // Se o campo estiver presente e estiver vazio, adiciona ao array de erros
            if ($value === '') {
                $camposObrigatorios[] = $key;
            }
        }

        if (!empty($camposObrigatorios)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Preencha todos os campos obrigatórios antes de enviar o formulário.'
            ]);
        }

        // Normaliza as respostas
        $normalize = fn($val) => trim($val) === '' ? null : htmlspecialchars($val);

        $replyData = [
            'form'        => $formHash,
            'question_1'  => $normalize($data['question_1'] ?? null),
            'question_2'  => $normalize($data['question_2'] ?? null),
            'question_3'  => $normalize($data['question_3'] ?? null),
            'nps'         => $normalize($data['nps'] ?? null),
            'csat'        => $normalize($data['csat'] ?? null),
            'client_name' => $normalize($data['name'] ?? null),
            'hash'        => bin2hex(random_bytes(8)), 
            'created_at'  => date('Y-m-d H:i:s'),
        ];

        $this->replyModel->insert($replyData); 

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Feedback enviado com sucesso!'
        ]);
    }


    private function generateQrCodeAndUpload ($url) {

        $options = new QROptions([
            'version'       => 7    ,
            'imageBase64'   => true ,
            'scale'         => 7    ,
        ]);

        $qrCode = (new QRCode($options))->render($url);

        $img = str_replace('data:image/png;base64', '', $qrCode);
       
        $arquivo_imagem = base64_decode($img);

        $directory = ROOTPATH . 'public/qrcodes/';
        $fileName  = uniqid() . '.png';

        $relativePath = 'qrcodes/' . $fileName; 
        
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents($directory . $fileName , $arquivo_imagem); 

        return $relativePath;

    }

}
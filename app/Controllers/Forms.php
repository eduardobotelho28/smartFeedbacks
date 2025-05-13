<?php

namespace App\Controllers;

use App\Models\FormsModel;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class Forms extends BaseController
{

    protected $model;

    public function __construct()
    {
        $this->model = new FormsModel();
    }

    public function userForms () {
        return view ('userForms/forms');
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
            'name'         => $data['name']                          ,
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
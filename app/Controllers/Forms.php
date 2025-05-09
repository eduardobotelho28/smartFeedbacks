<?php

namespace App\Controllers;

class Forms extends BaseController
{

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
            'name'          => 'required|alpha_space|min_length[5]'  ,
        ];

        $validationMessages = [
            'name' => [
                'required' => 'O nome do Formulário é obrigatório.',
                'alpha_space' => 'O nome deve conter apenas letras e espaços.'
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

        $formData = [
            'user'        => $user                         ,
            'name'        => $data['name']                 ,
            'question_1'  => $data['question_1'] ?? null   ,
            'question_2'  => $data['question_2'] ?? null   ,
            'question_3'  => $data['question_3'] ?? null   ,
            'add_nps'     => $add_nps                      , 
            'add_csat'    => $add_csat                     ,
            'hash'        => $hash                         ,               
            'public_link' => $publicLink                   ,
            'created_at'  => date('Y-m-d H:i:s')
        ];

        // Aqui seria a chamada ao model
        // $this->formModel->insert($formData);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Formulário criado com sucesso!'
        ]);

    }

    // public function register () {

    //     $data = $this->request->getPost();

    //     $validationRules = [
    //         'firstname'        => 'required|alpha_space'                             ,
    //         'lastname'         => 'required|alpha_space'                             ,
    //         'email'            => 'required|valid_email|is_unique[users.email]'      ,
    //         'password'         => 'required|min_length[6]'                           ,
    //         'password_confirm' => 'required|matches[password]'                       ,
    //     ];
    
    //     $validationMessages = [
    //         'firstname' => [
    //             'required' => 'O nome é obrigatório.',
    //             'alpha_space' => 'O nome deve conter apenas letras e espaços.'
    //         ],
    //         'lastname' => [
    //             'required' => 'O sobrenome é obrigatório.',
    //             'alpha_space' => 'O sobrenome deve conter apenas letras e espaços.'
    //         ],
    //         'email' => [
    //             'required' => 'O email é obrigatório.',
    //             'valid_email' => 'O email informado não é válido.',
    //             'is_unique'   => 'O email já está em uso',
    //         ],
    //         'password' => [
    //             'required' => 'A senha é obrigatória.',
    //             'min_length' => 'A senha deve ter no mínimo 6 caracteres.'
    //         ],
    //         'password_confirm' => [
    //             'required' => 'A confirmação de senha é obrigatória.',
    //             'matches' => 'A confirmação de senha deve ser igual à senha.'
    //         ],
    //     ];

    //     if (! $this->validate($validationRules, $validationMessages)) {
    //         return $this->response->setJSON([
    //             'success' => false,
    //             'message' => $this->validator->getErrors()
    //         ]);
    //     }

    //     try {
            
    //         $this->model->register($data);
            
    //         session()->setFlashdata('toast_message', [
    //             'type'    => 'success', 
    //             'message' => 'Usuário registrado com sucesso!'
    //         ]);

    //         return $this->response->setJSON([
    //             'success' => true,
    //             'message' => 'Usuário registrado com sucesso!'
    //         ]);
    //     } catch (\Throwable $e) {
           
    //         return $this->response->setJSON([
    //             'success' => false,
    //             'message' => 'Erro ao registrar usuário'
    //         ]);
    //     }
    // }

}
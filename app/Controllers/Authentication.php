<?php

namespace App\Controllers;

class Authentication extends BaseController
{
    public function login_view()
    {
        return view('auth/login');
    }

    public function register_view()
    {
        return view('auth/register');
    }

    public function register () {
        // echo json_encode(array("message" => "teste", "success" => true)) ; exit;

        $data = $this->request->getPost();

        $validationRules = [
            'first_name'       => 'required|alpha_space'      ,
            'last_name'        => 'required|alpha_space'      ,
            'email'            => 'required|valid_email'      ,
            'password'         => 'required|min_length[6]'    ,
            'password_confirm' => 'required|matches[password]',
        ];
    
        $validationMessages = [
            'first_name' => [
                'required' => 'O nome é obrigatório.',
                'alpha_space' => 'O nome deve conter apenas letras e espaços.'
            ],
            'last_name' => [
                'required' => 'O sobrenome é obrigatório.',
                'alpha_space' => 'O sobrenome deve conter apenas letras e espaços.'
            ],
            'email' => [
                'required' => 'O email é obrigatório.',
                'valid_email' => 'O email informado não é válido.'
            ],
            'password' => [
                'required' => 'A senha é obrigatória.',
                'min_length' => 'A senha deve ter no mínimo 6 caracteres.'
            ],
            'password_confirm' => [
                'required' => 'A confirmação de senha é obrigatória.',
                'matches' => 'A confirmação de senha deve ser igual à senha.'
            ],
        ];

        if (! $this->validate($validationRules, $validationMessages)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $this->validator->getErrors()
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Cadastro realizado com sucesso!'
        ]);
    }
}
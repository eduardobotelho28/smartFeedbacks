<?php

namespace App\Controllers;

use App\Models\AuthenticationModel;

class Authentication extends BaseController
{

    protected $model;

    public function __construct()
    {
        $this->model = new AuthenticationModel();
    }

    public function login_view() {
        return view('auth/login');
    }

    public function register_view() {
        return view('auth/register');
    }

    public function register () {

        $data = $this->request->getPost();

        $validationRules = [
            'firstname'        => 'required|alpha_space'                             ,
            'lastname'         => 'required|alpha_space'                             ,
            'email'            => 'required|valid_email|is_unique[users.email]'      ,
            'password'         => 'required|min_length[6]'                           ,
            'password_confirm' => 'required|matches[password]'                       ,
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
                'is_unique'   => 'O email já está em uso',
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

        try {
            
            $this->model->register($data);
            
            session()->setFlashdata('toast_message', [
                'type'    => 'success', 
                'message' => 'Usuário registrado com sucesso!'
            ]);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Usuário registrado com sucesso!'
            ]);
        } catch (\Throwable $e) {
           
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Erro ao registrar usuário'
            ]);
        }
    }

    public function login () {

        $data     = $this->request->getPost() ;
        $email    = $data['email']    ?? ''   ;
        $password = $data['password'] ?? ''   ;

        $user  = $this->model->getUserByEmail($email);

        if (! $user || ! password_verify($password, $user['password'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Email ou senha inválidos.'
            ]);
        }

        session()->set('user', $user['id']);
        session()->set('userName', $user['firstname']);

        return $this->response->setJSON([
            'success' => true
        ]);

    }

    public function logout() {
        session()->destroy(); 
        return redirect()->to('/'); 
    }

}
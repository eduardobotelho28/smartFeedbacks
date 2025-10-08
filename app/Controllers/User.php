<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function profile()
    {
        $user = session()->get('user');

        $data['user'] = $this->model->find($user);

        return view('user/profile', $data);
    }

    public function updateProfile()
    {
        $user = session()->get('user');

        $data = $this->request->getPost();

        $validationRules = [
            'firstname' => 'required|alpha_space',
            'lastname'  => 'required|alpha_space',
            'email'     => 'required|valid_email|is_unique[users.email,id,' . $user . ']'
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

        if (! $this->validate($validationRules, $validationMessages)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $this->validator->getErrors()
            ]);
        }

        try {
            $this->model->update($user, [
                'firstname' => $data['firstname'],
                'lastname'  => $data['lastname'],
                'email'     => $data['email'],
            ]);

            // Atualiza sessão
            session()->set('user', $user);
            session()->set('userName', $data['firstname']);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Perfil atualizado com sucesso!'
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Erro ao atualizar perfil.'
            ]);
        }
    }
}

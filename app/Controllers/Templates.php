<?php

namespace App\Controllers;

use App\Models\FormsModel;
use App\Models\FormsQuestionsModel;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class Templates extends BaseController
{
    protected $db;
    protected $formsModel;
    protected $formQuestionsModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->formsModel = new FormsModel();
        $this->formQuestionsModel = new FormsQuestionsModel();
    }

    public function choose()
    {
        return view('userForms/templates');
    }

    public function create()
    {
        $data = $this->request->getPost();
        $user = session()->get('user');

        $name       = trim($data['name'] ?? '')       ;
        $templateId = $data['template'] ?? null       ;

        // Regex permite letras (com acento), números e espaços
        $regexName = '/^[A-Za-zÀ-ÿ0-9\s]+$/u';

        if ($name === '' || !preg_match($regexName, $name)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'O nome do formulário contém caracteres inválidos ou está vazio.'
            ]);
        }

        if (!in_array((int)$templateId, [1, 2, 3], true)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Template inválido selecionado.'
            ]);
        }

        $hash       = bin2hex(random_bytes(10));
        $publicLink = site_url("forms/reply/{$hash}");
        $qrCodePath = $this->generateQrCodeAndUpload($publicLink);

        $formData = [
            'user'         => $user,
            'name'         => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            'hash'         => $hash,
            'qr_code_path' => $qrCodePath,
            'public_link'  => $publicLink,
            'created_at'   => date('Y-m-d H:i:s'),
        ];

        $this->formsModel->insert($formData);

        switch ((int)$templateId) {
            case 1:
                $this->template_todas_metricas($hash);
                break;
            case 2:
                $this->template_trio_chave($hash);
                break;
            case 3:
                $this->template_pesquisa_saida($hash);
                break;
        }

        session()->setFlashdata('toast_message', [
                'type'    => 'success', 
                'message' => 'Formulário criado com sucesso!'
            ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => ''
        ]);
    }

    private function template_todas_metricas(string $formHash)
    {
        $metricsData = [
            'form'                 => $formHash,
            'add_nps'              => 1,
            'add_csat'             => 1,
            'add_cli'              => 1,
            'add_ces'              => 1,
            'add_exit_survey'      => 0,
            'add_simple_star'      => 1,
        ];

        $this->formQuestionsModel->insert($metricsData);
    }

    private function template_trio_chave(string $formHash)
    {
        $metricsData = [
            'form'                 => $formHash,
            'add_nps'              => 1,
            'add_csat'             => 1,
            'add_cli'              => 0,
            'add_ces'              => 1,
            'add_exit_survey'      => 0,
            'add_simple_star'      => 0,
        ];

        $this->formQuestionsModel->insert($metricsData);
    }

    private function template_pesquisa_saida(string $formHash)
    {
        $metricsData = [
            'form'                 => $formHash,
            'add_nps'              => 0,
            'add_csat'             => 0,
            'add_cli'              => 0,
            'add_ces'              => 0,
            'add_exit_survey'      => 1,
            'add_simple_star'      => 1,
        ];

        $this->formQuestionsModel->insert($metricsData);
    }

    private function generateQrCodeAndUpload($url)
    {

        $options = new QROptions([
            'version'       => 7,
            'imageBase64'   => true,
            'scale'         => 7,
        ]);

        $qrCode = (new QRCode($options))->render($url);

        $img = str_replace('data:image/png;base64', '', $qrCode);

        $arquivo_imagem = base64_decode($img);

        // $directory = ROOTPATH . 'public/qrcodes/';

        $directory = FCPATH . 'qrcodes/';

        $fileName  = uniqid() . '.png';

        $relativePath = 'qrcodes/' . $fileName;

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        file_put_contents($directory . $fileName, $arquivo_imagem);

        return $relativePath;
    }
}

<?php

namespace App\Controllers;

class Summary extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function userSummary()
    {
        $user = session()->get('user');

        $feedbacks = $this->db->table('replies')
            ->select('replies.*, reply_questions.*, forms.name as form_name, forms.hash as form_hash')
            ->join('forms', 'forms.hash = replies.form')
            ->join('reply_questions', 'reply_questions.reply = replies.hash')
            ->where('forms.user', $user)
            ->orderBy('replies.created_at', 'DESC')
            ->get()
            ->getResultArray();

        $nps         = $this->calculateNPS         ($feedbacks);
        $csat        = $this->calculateCSAT        ($feedbacks);
        $cli         = $this->calculateCLI         ($feedbacks);
        $ces         = $this->calculateCES         ($feedbacks);
        $stars       = $this->calculateStars       ($feedbacks);
        $exitSurvey  = $this->calculateExitSurvey  ($feedbacks);
        $generalData = $this->calculateGeneralData ($feedbacks);

        $data = [
            'nps'        => $nps,
            'csat'       => $csat,
            'cli'        => $cli,
            'ces'        => $ces,
            'stars'      => $stars,
            'exitSurvey' => $exitSurvey,
            'general'    => $generalData
        ];

        return view('summary/summary.php', $data);
    }

    private function calculateNPS($feedbacks)
    {
        $promotores = $neutros = $detratores = $total = 0;

        foreach ($feedbacks as $fb) {
            if (!is_null($fb['nps']) && (int)$fb['nps'] > 0) {
                $nps = (int)$fb['nps'];
                $total++;

                if ($nps >= 9) $promotores++;
                elseif ($nps >= 7) $neutros++;
                else $detratores++;
            }
        }

        $npsScore = $total > 0
            ? round((($promotores - $detratores) / $total) * 100)
            : 0;

        return compact('promotores', 'neutros', 'detratores', 'total', 'npsScore');
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

        return compact('satisfeitos', 'total', 'csatPercent');
    }

    private function calculateCLI($feedbacks)
    {
        $fieis = $total = $soma = 0;

        foreach ($feedbacks as $fb) {
            if (!is_null($fb['cli']) && (int)$fb['cli'] > 0) {
                $cli = (int)$fb['cli'];
                $total++;
                $soma += $cli;
                if ($cli >= 8) $fieis++;
            }
        }

        $media = $total > 0 ? round($soma / $total, 1) : 0;
        $percentFieis = $total > 0 ? round(($fieis / $total) * 100) : 0;

        return [
            'media'        => $media,
            'qtd_fieis'    => $fieis,
            'total'        => $total,
            'percentFieis' => $percentFieis
        ];
    }

    private function calculateCES($feedbacks)
    {
        $total = $soma = 0;

        foreach ($feedbacks as $fb) {
            if (!is_null($fb['ces']) && (int)$fb['ces'] > 0) {
                $ces = (int)$fb['ces'];
                $total++;
                $soma += $ces;
            }
        }

        $media = $total > 0 ? round($soma / $total, 1) : 0;
        $facilidadePercent = $total > 0
            ? round((($media / 7) * 100))
            : 0;

        return compact('media', 'total', 'facilidadePercent');
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

        return compact('media', 'total');
    }

    private function calculateExitSurvey($feedbacks)
    {
        $totalExit = 0;
        $comTexto = 0;

        foreach ($feedbacks as $fb) {
            if (isset($fb['exit_survey']) && trim($fb['exit_survey']) !== '') {
                $totalExit++;
                $comTexto++;
            }
        }

        $percentRespondidos = $totalExit > 0
            ? round(($comTexto / $totalExit) * 100)
            : 0;

        return [
            'total_exit'        => $totalExit,
            'respondidos'       => $comTexto,
            'percentRespondidos'=> $percentRespondidos
        ];
    }

    private function calculateGeneralData($feedbacks)
    {
        $totalRespostas = count($feedbacks);

        $forms = [];
        foreach ($feedbacks as $fb) {
            $forms[$fb['form_name']] = ($forms[$fb['form_name']] ?? 0) + 1;
        }

        return [
            'total_respostas' => $totalRespostas,
            'forms'           => $forms
        ];
    }
}

<?php

namespace App\Controllers;

use App\Models\FormsModel;
use App\Models\ReplyModel;

class Feedbacks extends BaseController
{
    protected $formModel;
    protected $replyModel;
    protected $db;

    public function __construct()
    {
        $this->formModel  = new FormsModel();
        $this->replyModel = new ReplyModel();
        $this->db         = \Config\Database::connect();
    }

    public function myFeedbacks()
    {
        $user = session()->get('user');

        $builder = $this->db->table('replies');
        $builder->select('replies.*, forms.name as form_name');
        $builder->join('forms', 'forms.hash = replies.form');
        $builder->where('forms.user', $user);
        $builder->orderBy('replies.created_at', 'DESC');

        $feedbacks = $builder->get()->getResultArray();

        // ---------------------------------------------------------------------------------------- //
        // ---------------------- CALCULA E MONTA INFORMAÇÕES DE NPS ------------------------------ // 
        // ---------------------------------------------------------------------------------------- //

        $promotores = 0;
        $neutros    = 0;
        $detratores = 0;

        $totalAvaliacoesNps = 0;

        foreach ($feedbacks as $fb) {
            if (!is_null($fb['nps'])) {
                $nps = (int) $fb['nps'];
                $totalAvaliacoesNps++;

                if ($nps >= 9) {
                    $promotores++;
                } elseif ($nps >= 7) {
                    $neutros++;
                } else {
                    $detratores++;
                }
            }
        }

        $percentPromotores = $totalAvaliacoesNps > 0 ? ($promotores / $totalAvaliacoesNps) * 100 : 0;
        $percentDetratores = $totalAvaliacoesNps > 0 ? ($detratores / $totalAvaliacoesNps) * 100 : 0;
        $npsScore = round($percentPromotores - $percentDetratores);

        $data['nps'] = [
            'qtd_promotores' => $promotores,
            'qtd_neutros'    => $neutros,
            'qtd_detratores' => $detratores,
            'total'          => $totalAvaliacoesNps,
            'nps'            => $npsScore
        ];

        // ---------------------------------------------------------------------------------------- //
        // ---------------------------------------------------------------------------------------- //
        // ---------------------------------------------------------------------------------------- //

        // ---------------------------------------------------------------------------------------- //
        // ---------------------- CALCULA E MONTA INFORMAÇÕES DE CSAT ----------------------------- // 
        // ---------------------------------------------------------------------------------------- //

        $satisfeitos = 0;
        $totalCsat   = 0;

        foreach ($feedbacks as $fb) {
            if (!is_null($fb['csat'])) {
                $csat = (int) $fb['csat'];
                $totalCsat++;

                if ($csat >= 4) {
                    $satisfeitos++;
                }
            }
        }

        $csatPercent = $totalCsat > 0 ? round(($satisfeitos / $totalCsat) * 100) : 0;

        $data['csat'] = [
            'qtd_satisfeitos' => $satisfeitos,
            'total'           => $totalCsat,
            'csat'            => $csatPercent
        ];

        // ---------------------------------------------------------------------------------------- //
        // ---------------------------------------------------------------------------------------- //
        // ---------------------------------------------------------------------------------------- //

        $data['feedbacks'] = $feedbacks;

        return view('feedbacks/all', $data);
    }

    public function view($hash)
    {
        
        $reply = $this->replyModel
            ->where('hash', $hash)
            ->first();

        if (! $reply) {
            return redirect()->to('/feedbacks')->with('error', 'Resposta não encontrada.');
        }

        $form = $this->formModel
            ->where('hash', $reply['form'])
            ->first();

        if (! $form) {
            return redirect()->to('/feedbacks')->with('error', 'Formulário relacionado não encontrado.');
        }

        return view('feedbacks/reply', [
            'reply' => $reply,
            'form'  => $form,
        ]);
    }

    public function delete($hash)
    {
        $reply = $this->replyModel->where('hash', $hash)->first();

        if (! $reply) {
            return redirect()->to('/feedbacks')->with('error', 'Resposta não encontrada.');
        }

        $this->replyModel->where('hash', $hash)->delete();

        return redirect()->to('/feedbacks')->with('success', 'Resposta excluída com sucesso!');
    }

}

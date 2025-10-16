<?php

namespace App\Models;

use CodeIgniter\Model;

class FormsQuestionsModel extends Model
{
    protected $table      = 'form_questions';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'form',
        'add_nps',
        'add_csat',
        'add_cli',
        'add_ces',
        'add_exit_survey',
        'add_simple_star',
        'free_question_1',
        'free_question_2',
    ];

}

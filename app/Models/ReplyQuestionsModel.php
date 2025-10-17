<?php

namespace App\Models;

use CodeIgniter\Model;

class ReplyQuestionsModel extends Model
{
    protected $table      = 'reply_questions';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'reply',
        'nps',
        'csat',
        'cli',
        'ces',
        'exit_survey',
        'simple_star',
        'free_question_1',
        'free_question_2',
    ];

}

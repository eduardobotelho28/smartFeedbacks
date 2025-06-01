<?php

namespace App\Models;

use CodeIgniter\Model;

class ReplyModel extends Model
{
    protected $table      = 'replies';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'hash', 'form', 'question_1', 'question_2', 'question_3',
        'nps', 'csat', 'client_name', 'created_at'
    ];
}

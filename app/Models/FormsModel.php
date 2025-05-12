<?php

namespace App\Models;

use CodeIgniter\Model;

class FormsModel extends Model
{
    protected $table = 'forms';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user', 'name', 'question_1', 'question_2', 'question_3',
        'add_nps', 'add_csat', 'hash', 'public_link', 'created_at'
    ];

}

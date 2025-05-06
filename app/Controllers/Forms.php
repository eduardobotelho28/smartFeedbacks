<?php

namespace App\Controllers;

class Forms extends BaseController
{

    public function userForms () {
        echo 'aqui' ; exit; 
    }

    public function createFormView () {
        return view ('userForms/create');
    }

}
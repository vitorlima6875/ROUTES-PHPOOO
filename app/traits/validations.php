<?php

namespace   app\traits;

use app\core\Request;
use app\support\flash;

trait validations 
{
    public function unique($field)
    {

    }

    public function email($field)
    {
        if (!filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL)){
            flash::set($field, "Esse campo tem que ter um email válido");
            return null;
        }
        return strip_tags(Request::input($field), '<p><b><ul><span><em>');

    }

    public function required($field)
    {
        $data = Request::input($field);
            if (empty($data)){
            flash::set($field, "Esse campo e obrigatorio");
            return null;
            }

            return strip_tags($data, '<p><b><ul><span><em>');
    }

    public function maxLen($field, $param)
    {
        $data = Request::input($field);

        if (strlen($data) > $param) {
            flash::set($field, "Esse tem que ter no máximo {$param} caracteres");
            return null;
        }
        return strip_tags($data, '<p><b><ul><span><em>');

        //dd($data);
    }

}
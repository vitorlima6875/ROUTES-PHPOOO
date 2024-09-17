<?php

namespace app\Controllers;


class UserController extends Controller
{
    public function edit()
    {
        $this->view('user',  ['title' => 'Editar Use']);

    }
    public function update($params)
    {
        
        dd(array($params));
    }
}

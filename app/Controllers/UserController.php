<?php

namespace app\Controllers;
use app\core\request;

class UserController extends Controller
{
    public function edit()
    {
        $this->view('user',  ['title' => 'Editar Use']);

    }
    public function update($params)
    {
        $response = request::only(['firstName', 'lastName']);
       dd($response);
    }
}

<?php

namespace app\Controllers;

use app\core\request;
use app\support\csrf;
use app\support\validate;

class UserController extends Controller
{
    public function edit()
    {
        $this->view('user',  ['title' => 'Editar Use']);

    }
    public function update($params)
    {
        $validate = new validate;
        $validated = $validate->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'email|required',
            'password' => 'maxlen:5|required'
        ]);

        if (!$validated){
            return redirect('/user/12');
        }

       dd($validated);

    }
}

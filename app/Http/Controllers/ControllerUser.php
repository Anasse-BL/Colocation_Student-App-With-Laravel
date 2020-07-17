<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControllerUser extends Controller
{
    public function getInscrire(){
        request()->validate([
            'name'=>['required'],
            'email'=>['required','email','unique:users'],
            'password'=>['required']
        ]);
    }
}

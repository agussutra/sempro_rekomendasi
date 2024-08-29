<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return View('data.daftar');
    }

    public function login()
    {
        return View('data.login');
    }

    public function checkLogin(Request $r){
        $email = $r->email;
        $password = $r->password;

        if($email == "admin"){
            if($password == "123"){
                return redirect(url('/'));
            }else{
                return redirect(url('data.login'));
            }
        }else{
            return redirect(url('data/login'));
        }

    }
}

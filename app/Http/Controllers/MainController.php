<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function userRegistration(){
        return view('frontend.user-registration');
    }
    public function userLogin(){
        return view('frontend.user-login');
    }
    public function index(){
        return view('frontend.index');
    }
}

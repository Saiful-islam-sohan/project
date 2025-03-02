<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('backend.master');
    }
    public function login()
    {
        return "login";
    }
}

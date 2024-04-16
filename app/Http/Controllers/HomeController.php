<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('company', [
            'title' => 'Bitme | Home'
        ]);
    }

    public function profil()
    {
        return view('user.profile', ['title' => 'Bitme | Profile']);
    }
}

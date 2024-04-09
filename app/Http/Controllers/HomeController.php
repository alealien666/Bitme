<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('company', [
            'title' => 'Elaku | Home'
        ]);
    }

    public function profil()
    {
        return view('auth.user.profile', ['title' => 'Elaku | Profile']);
    }
}

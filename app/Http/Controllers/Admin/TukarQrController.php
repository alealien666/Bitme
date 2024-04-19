<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\TukarQr;
use Illuminate\Http\Request;

class TukarQrController extends Controller
{
    public function index()
    {
        $codes = TukarQr::with('user', 'qr')
            ->get()
            ->groupBy('user_id');

        return view('admin.tampilan.tukarQr', compact('codes'))->with('title', 'Bitme | Tukar Code');
    }

    public function tukarKode()
    {
    }
}

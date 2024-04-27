<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\TukarQr;
use App\Models\QrCode;
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

    public function tukarKode(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:qr_codes,id',
        ]);

        $ids = $request->input('ids');

        QrCode::whereIn('id', $ids)->update(['status' => 'di tukar']);

        return redirect()->back()->with('success', 'Berhasil Verifikasi QrCode');
    }
}

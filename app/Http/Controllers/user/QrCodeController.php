<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\QrCode;
use Illuminate\Http\Request;


class QrCodeController extends Controller
{
    public function index()
    {
        $qrCode = QrCode::with('user')->get();
        return view('user.redeem', compact('qrCode'))->with('title', 'Bitme | Redeem');
    }

    public function redeem(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        $qrcode = QRCode::where('code', $request->code)->first();

        if ($qrcode == null || $qrcode->redeemed === 1) {
            return redirect()->back()->with('error', 'kode yang anda masukkan tidak valid');
        } else {
            $qrcode->update([
                'user_id' => auth()->user()->id,
                'redeemed' => true,
            ]);

            return redirect()->back()->with('success', 'Berhasil menyimpan Qr Code');
        }
    }

    public function show($kode)
    {
        $qrCode = QrCode::with('user')->get();
        return view('user.redeem', compact('kode', 'qrCode'))->with('title', 'Bitme | Redeem');
    }
}

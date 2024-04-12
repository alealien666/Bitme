<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\URL;


class QrCodeController extends Controller
{
    public function index()
    {
        $qrCode = QrCode::with('user')->get();
        return view('user.redeem', compact('qrCode'))->with('title', 'Elaku | Redeem');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:qr_codes'
        ], [
            'code.unique' => 'Kode QR ini sudah pernah digunakan sebelumnya.'
        ]);

        QrCode::create([
            'code' => $request->code,
            'user_id' => auth()->user()->id,
        ]);

        $qrcode = QRCode::where('code', $request->code)->first();
        $qrcode->update([
            'redeemed' => true,
        ]);

        return redirect()->back()->with('success', 'Berhasil menyimpan Qr Code');
    }

    public function show($kode)
    {
        $qrCode = QrCode::with('user')->get();
        return view('user.redeem', compact('kode', 'qrCode'))->with('title', 'Elaku | Redeem');
    }
}

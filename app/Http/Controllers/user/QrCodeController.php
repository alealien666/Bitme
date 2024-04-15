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
        return view('user.redeem', compact('qrCode'))->with('title', 'Elaku | Redeem');
    }

    public function create(Request $request)
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:qr_codes'
        ]);

        QrCode::create([
            'code' => $request->code,
            'user_id' => auth()->user()->id,
            'token' => 908008,
        ]);

        $qrcode = QRCode::where('code', $request->code)->first();
        $qrcode->update([
            'redeemed' => true,
        ]);

        return redirect()->back()->with('success', 'berhasil menyimpan Qr Code');
    }


    public function show($kode)
    {
        $qrCode = QrCode::with('user')->get();
        return view('user.redeem', compact('kode', 'qrCode'))->with('title', 'Elaku | Redeem');
    }


    public function edit(QrCode $qrCode)
    {
        //
    }


    public function update(Request $request, QrCode $qrCode)
    {
        //
    }

    public function destroy(QrCode $qrCode)
    {
        //
    }
}

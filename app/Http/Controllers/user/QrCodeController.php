<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\QrCode;
use Illuminate\Http\Request;

class QrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $qrCode = QRCode::get();
        return view('redeem', compact('qrCode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:qr_codes|exists:qr_codes,code|redeemed:false'
        ]);

        QrCode::create([
            'code' => $request->code
        ]);

        $qrcode = QRCode::where('code', $request->code)->first();
        $qrcode->update([
            'redeemed' => true,
        ]);

        return redirect()->back()->with('success', 'berhasil menyimpan Qr Code');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(QrCode $qrCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QrCode $qrCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QrCode $qrCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QrCode $qrCode)
    {
        //
    }
}

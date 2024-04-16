<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenerateQrController extends Controller
{
    public function generateAndShowQrCode()
    {
        $nomorRandom = rand(100000, 999999);
        $url = route('redeem.page', ['kode' => $nomorRandom]);
        $token = Str::random(10); // Generate token unik
        $qrCode = QrCode::format('png')->size(300)->generate($url);
        $filename = 'qr_code_' . $nomorRandom . '.png';
        Storage::disk('public')->put($filename, $qrCode);

        // Simpan informasi QR code ke dalam database
        QRCode::create([
            'code' => $nomorRandom,
            'redeemed' => false,
            'status' => 'baru'
        ]);

        return view('qr', ['qrCodeFileName' => $filename]);
    }
}

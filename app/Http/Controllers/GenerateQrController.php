<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class GenerateQrController extends Controller
{
    public function generateAndShowQrCode()
    {
        $nomorRandom = rand(100000, 999999);
        $url = route('redeem.page', ['kode' => $nomorRandom]);
        $qrCode = QrCode::format('png')->size(300)->generate($url);
        $filename = 'qr_code_' . $nomorRandom . '.png';
        Storage::disk('public')->put($filename, $qrCode);
        return view('qr', ['qrCodeFileName' => $filename]);
    }
}

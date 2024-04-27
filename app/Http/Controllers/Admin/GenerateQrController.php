<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Models\QrCode as QRCodeModel;

class GenerateQrController extends Controller
{
    public function generateAndShowQrCode()
    {
        $nomorRandom = rand(100000, 999999);
        $url = route('redeem.page', ['kode' => $nomorRandom]);
        $qrCode = QrCode::format('png')->size(300)->generate($url);
        $filename = 'qr_code_' . $nomorRandom . '.png';
        Storage::disk('public')->put($filename, $qrCode);

        QRCodeModel::create([
            'code' => $nomorRandom,
            'redeemed' => false,
            'status' => 'baru',
        ]);

        return view('admin.tampilan.qr', ['qrCodeFileName' => $filename]);
    }

    public function qr()
    {
        $kode = QrCodeModel::all();

        return view('admin.tampilan.dataQr', compact('kode'))->with('title', 'Bitme | Data Qr');
    }
}

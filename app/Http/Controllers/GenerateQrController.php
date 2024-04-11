<?php

namespace App\Http\Controllers;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class GenerateQrController extends Controller
{
    public function generateAndShowQrCode()
    {
        // Generate nomor random untuk QR code
        $nomorRandom = rand(100000, 999999);

        // URL untuk halaman redeem kode dengan nomor random sebagai parameter
        $url = route('redeem.page', ['kode' => $nomorRandom]);

        // Generate QR code
        $qrCode = QrCode::format('png')->size(300)->generate($url);

        // Simpan QR code sebagai gambar
        $filename = 'qr_code_' . $nomorRandom . '.png'; // nama file QR code sesuai dengan nomor random
        Storage::disk('public')->put($filename, $qrCode);

        // Tampilkan view dengan QR code
        return view('qr', ['qrCodeFileName' => $filename]);
    }

    public function show($kode)
    {
        // Di sini Anda bisa melakukan validasi kode, misalnya memeriksa apakah kode tersebut valid dalam sistem Anda
        // Kemudian Anda dapat melakukan tindakan yang sesuai, seperti memberikan diskon atau mengonfirmasi pembelian

        return view('redeem', compact('kode'));
    }
}

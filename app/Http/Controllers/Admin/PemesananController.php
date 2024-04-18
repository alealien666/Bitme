<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\detail_order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PemesananController extends Controller
{
    public function index()
    {
        $listPemesanan = Order::select(
            'orders.id as id_pemesanan',
            'orders.status',
            'orders.total_biaya',
            'orders.bukti_pembayaran',
            'orders.expired_at',
            'users.name as nama',
            'users.email',
            'users.alamat',
            'users.no_telp'
        )->join('users', 'orders.user_id', '=', 'users.id')->get();
        foreach ($listPemesanan as $index => $value) {
            $product = detail_order::join('products', 'products.id', '=', 'detail_orders.product_id')
                ->join('rasas', 'rasas.id', '=', 'products.rasa_id')
                ->select(
                    'products.nama_product',
                    'products.harga',
                    'rasas.varian_rasa',
                    'detail_orders.jumlah_beli'
                )
                ->where('detail_orders.order_id', $value->id_pemesanan)
                ->get();



            $listPemesanan[$index]->product = $product;
        }

        $jumlahPending = count($listPemesanan->where('status', 'pending'));
        $jumlahApproved = count($listPemesanan->where('status', 'approved'));

        return view('admin.tampilan.pemesanan', compact('listPemesanan', 'jumlahApproved', 'jumlahPending'));
    }

    public function verifikasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'string|required',
            'fileInput' => 'image|file|max:2000'
        ]);

        $verifikasi = Order::findOrFail($id);

        if ($request->has('submit')) {
            $verifikasi->status = 'approved';
            $verifikasi->update();
        }

        return redirect()->back()->with('success', 'Pesanan Di Verifikasi');
    }

    // public function entryDataHasilAnalisis(Request $request, $id)
    // {
    //     $request->validate([
    //         'status' => 'required|string',
    //         'kondisi' => 'required|string'
    //     ]);

    //     $hasil = Order::findOrFail($id);

    //     $entryData = new HasilAnalisis();
    //     $entryData->order_id = $hasil->id;
    //     $entryData->status = $request->input('status');
    //     $entryData->kondisi_sample = $request->input('kondisi');
    //     $entryData->tanggal_terbit = now()->format('Y-m-d');
    //     $entryData->save();

    //     $pdfPath = $this->generateCoAPdf($hasil);

    //     $hasilAnalisis = HasilAnalisis::where('order_id', $hasil->id)->first();
    //     $notif = new NotifHasilAnalisis($hasil, $hasilAnalisis, $pdfPath);
    //     $hasil->user->notify($notif);

    //     return redirect()->back()->with('success', 'Berhasil Input Hasil');
    // }
}

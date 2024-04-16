<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\detail_order;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class riwayatPemesananController extends Controller
{
    public function index()
    {
        $listPemesanan = Order::select(
            'orders.id as id_pemesanan',
            'orders.status',
            'orders.total_biaya',
            'orders.nama_pemesan',
            'orders.no_telp',
            'orders.bukti_pembayaran',
            'orders.expired_at',
            'users.name as nama',
        )->join('users', 'orders.user_id', '=', 'users.id')
            ->where('orders.user_id', Auth::id())
            ->whereNotNull('orders.expired_at')
            ->get();

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
        return view('user.riwayatPemesanan', compact('listPemesanan', 'jumlahPending', 'jumlahApproved'), [
            'title' => 'Bitme | Riwayat Pemesanan'
        ]);
    }

    public function batal($id)
    {
        // Ambil order yang akan dibatalkan
        $order = DB::table('orders')->where('id', $id)->first();

        // Jika order ditemukan
        if ($order) {
            // Ambil detail order terkait dengan order yang akan dibatalkan
            $detailOrders = DB::table('detail_orders')->where('order_id', $id)->get();

            // Jika ada detail order terkait
            if ($detailOrders->isNotEmpty()) {
                // Lakukan iterasi pada setiap detail order
                foreach ($detailOrders as $detailOrder) {
                    // Perbarui stok produk terkait
                    DB::table('products')
                        ->where('id', $detailOrder->product_id)
                        ->increment('stok', $detailOrder->jumlah_beli);
                }
            }
            DB::table('orders')->where('id', $id)->delete();

            return redirect()->back()->with('success', 'Pesanan Anda telah dibatalkan dan otomatis akan terhapus dari riwayat pesanan');
        }
    }
}

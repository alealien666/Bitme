<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\detail_order;
use App\Models\Order;
use App\Models\Lab;
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
                ->select(
                    'products.nama_product',
                    'products.harga',
                    'detail_orders.jumlah_beli'
                )
                ->where('detail_orders.order_id', $value->id_pemesanan)
                ->get();

            $listPemesanan[$index]->product = $product;
        }
        $jumlahPending = count($listPemesanan->where('status', 'pending'));
        $jumlahApproved = count($listPemesanan->where('status', 'approved'));
        return view('user.riwayatPemesanan', compact('listPemesanan', 'jumlahPending', 'jumlahApproved'), [
            'title' => 'Elaku | Riwayat Pemesanan'
        ]);
    }
}

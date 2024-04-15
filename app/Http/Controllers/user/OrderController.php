<?php


namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;


class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required|max:255|string",
            "notelp" => "required|numeric",
            "selected_product" => "required|array",
            "alamat" => "required|string",
            "jumlah_beli" => "required|array",
        ]);


        $selectedProduct = $request->input('selected_product');
        $totalCost = 0;

        session([
            'personal_info' => [
                'nama' => $request->input('nama'),
                'notelp' => $request->input('notelp'),
                'alamat' => $request->input('alamat'),
                'selected_product' => $selectedProduct,
            ]
        ]);

        $new_array = [];
        foreach ($request->input("jumlah_beli") as $key => $value) {
            if (in_array($key, $request->input("selected_product"))) {
                $new_array[$key] = $value;
            }
        }
        $expiredAt = now()->addHour();

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->alamat = $request->input('alamat');
        $order->nama_pemesan = $request->input('nama');
        $order->no_telp = $request->input('notelp');
        $order->total_biaya = 0;
        $order->status = 'pending';
        $order->expired_at = $expiredAt;
        $order->save();

        foreach ($selectedProduct as $index => $selectedProductId) {
            if (is_numeric($selectedProductId)) {
                $jumlahBeli = isset($new_array[$selectedProductId]) ? $new_array[$selectedProductId] : 0;
                $order->product()->attach($selectedProductId, [
                    'jumlah_beli' => $jumlahBeli
                ]);
                $product = Product::find($selectedProductId);
                $harga = $product->harga;
                $totalBiaya = $harga * $jumlahBeli;
                $totalCost += $totalBiaya;

                $product->update(['stok' => $product->stok - $jumlahBeli]);
                $jumlahBeliArray[$selectedProductId] = $jumlahBeli;
            }
        }
        $order->total_biaya = $totalCost;
        $order->save();

        session([
            'total_biaya' => $totalCost,
            'jumlah_beli' => $jumlahBeliArray,
        ]);

        return redirect()->back()->with('success', 'Lanjutkan untuk melakukan pembayaran.');
    }

    public function show()
    {
        $selectedProductIds = session('personal_info.selected_product', []);
        $selectedProduct = Product::whereIn('id', $selectedProductIds)->get();
        // $product = Product::where('slug', $slug)->firstOrFail();
        // $categoryProduct = $product->category;
        $product = Product::with('rasa')->get();
        // $product->each(function ($product) {
        //     $product->harga = number_format($product->harga, 0, ',', '.');
        // });

        return view('user.order', compact('product', 'selectedProduct',))->with('title', 'Bitme | Order');
    }

    public function uploadPembayaran(Request $request, $id)
    {
        $request->validate([
            'bukti' => 'required|image|mimes:jpg,jpeg,pdf,png|max:2000'
        ]);

        $upload = Order::findOrFail($id);

        if ($request->has('submit')) {
            $namaBerkas = $request->file('bukti')->store('img/bukti-pembayaran', 'public');
            $upload->bukti_pembayaran = $namaBerkas;
            $upload->update();
        } elseif ($request->has('update')) {
            if ($request->status === 'approved' && $request->file('fileInput')) {
                File::delete("img/bukti-pembayaran/" . basename($upload->bukti_pembayaran));
                $namaBerkas = $request->file('fileInput')->store('img/bukti-pembayaran', 'public');
                $upload->bukti_pembayaran = $namaBerkas;

                $upload->update();
            }
        }

        return redirect()->back()->with('success', 'Berhasil Mengunggah Bukti Pembayaran.. Silahkan tunggu admin meng approve pesanan kamu');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Rasa;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;

class listProductController extends Controller
{

    public function index()
    {
        $listProduct = Product::with('rasa')->get();
        $rasas = Rasa::all();
        return view('admin.tampilan.listProduct', compact('listProduct', 'rasas'));
    }

    // add data alat
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rasa' => 'required',
            'nama_product' => 'required|string',
            'stok' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string|min:0',
            'foto' => 'image|file|max:2000',
            'tanggal' => 'required|date|after_or_equal:' . Carbon::now()->toDateString()
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->file('foto')) {
            $namaBerkas = $request->file('foto')->storePublicly('img/produk', 'public');
            $product = new Product();
            $product->rasa_id = $request->input('rasa');
            $product->nama_product = $request->input('nama_product');
            $product->stok = $request->input('stok');
            $product->harga = $request->input('harga');
            $product->deskripsi = $request->input('deskripsi');
            $product->tanggal_expired = $request->input('tanggal');
            $product->foto_produk = $namaBerkas;
            $product->save();
        }
        return redirect()->route('Admin.list-product.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    // update data alat
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'rasa' => 'required',
            'nama_product' => 'required|string',
            'deskripsi' => 'required|string',
            'stok' => 'required|numeric|min:0',
            'harga' => 'required|numeric|min:0',
            'foto' => 'image|file|max:2000',
            'tanggal' => 'required|date|after_or_equal:' . Carbon::now()->toDateString()
        ]);

        $product = Product::findOrFail($id);

        if ($request->file('foto') == "") {
            $product->rasa_id = $request->rasa;
            $product->nama_product = $request->nama_product;
            $product->stok = $request->stok;
            $product->harga = $request->harga;
            $product->deskripsi = $request->deskripsi;
            $product->tanggal_expired = $request->input('tanggal');
            $product->update();
        } else {
            File::delete("img/produk/" . basename($product->foto_produk));
            $namaBerkas = $request->file('foto')->storePublicly('img/produk', 'public');
            $product->rasa_id = $request->rasa;
            $product->nama_product = $request->nama_product;
            $product->stok = $request->stok;
            $product->harga = $request->harga;
            $product->deskripsi = $request->deskripsi;
            $product->foto_produk = $namaBerkas;
            $product->tanggal_expired = $request->input('tanggal');
            $product->update();
        }
        return redirect()->back()->with('success', 'Data Berhasil di Perbarui');
    }

    // delete data alat
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // Storage::delete($Alat->photo);
        File::delete("img/produk/" . basename($product->foto_produk));
        $product->delete();
        return redirect()->route('Admin.list-product.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}

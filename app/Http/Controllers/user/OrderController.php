<?php


namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Alat_Tambahan;
use App\Models\Lab;
use App\Models\Analisis;
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
            "masuk" => ["required", "date", "after_or_equal:" . Carbon::now()->toDateString()],
            "selected_alat" => "required|array",
            "alamat" => "required|string",
            "jumlah_alat" => "required|array",
        ]);


        $selectedAlat = $request->input('selected_alat');
        $totalCost = 0;

        // $waktuOrder = now();
        session([
            'personal_info' => [
                'nama' => $request->input('nama'),
                'id_lab' => $request->input('id_lab'),
                'notelp' => $request->input('notelp'),
                'jenispesanan' => 'Sewa Lab',
                'alamat' => $request->input('alamat'),
                'masuk' => $request->input('masuk'),
                'keluar' => $request->input('keluar'),
                'lab' => $request->input('lab'),
                'selected_alat' => $selectedAlat,
            ]
        ]);

        $new_array = [];
        foreach ($request->input("jumlah_alat") as $key => $value) {
            if (in_array($key, $request->input("selected_alat"))) {
                $new_array[$key] = $value;
            }
        }
        $expiredAt = now()->addHour();

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->id_lab = $request->input('id_lab');
        $order->jenis_pesanan = 'Sewa Lab';
        $order->alamat = $request->input('alamat');
        $order->nama_pemesan = $request->input('nama');
        $order->no_telp = $request->input('notelp');
        $order->order = $request->input('masuk');
        $order->total_biaya = 0;
        $order->status = 'pending';
        $order->expired_at = $expiredAt;
        $order->save();

        foreach ($selectedAlat as $index => $selectedAlatId) {
            if (is_numeric($selectedAlatId)) {
                $jumlahAlat = isset($new_array[$selectedAlatId]) ? $new_array[$selectedAlatId] : 0;
                $order->alat()->attach($selectedAlatId, [
                    'jumlah_alat' => $jumlahAlat
                ]);
                $alat = Alat_Tambahan::find($selectedAlatId);
                $harga = $alat->harga;
                $totalBiaya = $harga * $jumlahAlat;
                $totalCost += $totalBiaya;

                $alat->update(['jumlah' => $alat->jumlah - $jumlahAlat]);
                $jumlahAlatArray[$selectedAlatId] = $jumlahAlat;
            }
        }
        $order->total_biaya = $totalCost;
        $order->save();

        session([
            'total_biaya' => $totalCost,
            'jumlah_alat' => $jumlahAlatArray,
        ]);

        return redirect()->back()->with('success', 'Lanjutkan untuk melakukan pembayaran.');
    }

    public function show($slug)
    {
        $selectedAlatIds = session('personal_info.selected_alat', []);
        $selectedAlat = Alat_Tambahan::whereIn('id', $selectedAlatIds)->get();
        $lab = Lab::where('slug', $slug)->firstOrFail();
        $categorylab = $lab->category;
        $alat = Alat_Tambahan::whereHas('category', function ($query) use ($categorylab) {
            $query->where('id', $categorylab->id);
        })->get();
        $alat->each(function ($alat) {
            $alat->harga = number_format($alat->harga, 0, ',', '.');
        });

        $usedDate = Order::where('status', 'approved')
            ->where('id_lab', $lab->id)
            ->whereDate('order', '>=', today()->format('Y-m-d'))
            ->pluck('order')
            ->toArray();

        return view('auth.user.order', compact('lab', 'categorylab', 'alat', 'selectedAlat', 'usedDate'))->with('title', 'Silab | Order');
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

    public function showOrderAnalisis($slug)
    {
        $analis = Analisis::where('slug', $slug)->firstOrFail();
        $usedDate = Order::where('status', 'approved')
            ->where('analisis_id', $analis->id)
            ->whereDate('order', '>=', today()->format('Y-m-d'))
            ->pluck('order')
            ->toArray();
        return view('auth.user.orderAnalisis', compact('analis', 'usedDate'))->with('title', 'Silab | Order');
    }

    public function orderAnalisis(Request $request)
    {
        $request->validate([
            "nama" => "required|max:255|string",
            "notelp" => "required|numeric",
            "alamat" => "required|string",
            "masuk" => ["required", "date", "after_or_equal:" . Carbon::now()->toDateString()],
        ]);
        $expiredAt = now()->addHour();

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->analisis_id = $request->input('id_analisis');
        $order->jenis_pesanan = 'Jasa Analisis';
        $order->nama_pemesan = $request->input('nama');
        $order->alamat = $request->input('alamat');
        $order->no_telp = $request->input('notelp');
        $order->order = $request->input('masuk');
        $order->total_biaya = $request->input('harga');
        $order->status = 'pending';
        $order->expired_at = $expiredAt;
        $order->save();

        return redirect('/user/riwayat-pemesanan')->with('success', 'Pesanan Berhasil Dibuat. Silahkan upload bukti pembayaran di sini');
    }
}

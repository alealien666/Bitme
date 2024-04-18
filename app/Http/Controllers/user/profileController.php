<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\File;

class profileController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.editProfile', compact('users'))->with('title', 'Bitme | Edit Profile');
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no' => 'required|string|max:255',
            'gender' => 'required|string|in:laki laki,perempuan',
            'pp' => 'image|max:2048',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('pp')) { // Memeriksa apakah file diunggah
            // Menghapus file gambar yang lama
            File::delete(public_path('img/avatar/' . basename($user->avatar)));

            // Menyimpan gambar yang baru diunggah
            $namaBerkas = $request->file('pp')->storePublicly('img/avatar', 'public');
            $user->avatar = $namaBerkas; // Menggunakan 'avatar' bukan 'avatvar'
        }

        // Mengupdate data pengguna
        $user->name = $request->nama;
        $user->alamat = $request->alamat;
        $user->no_telp = $request->no;
        $user->gender = $request->gender;
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }


    // public function updateProfile(Request $request, $id)
    // {
    //     // Validasi data yang dikirim oleh form
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'alamat' => 'required|string|max:255',
    //         'no' => 'required|string|max:255',
    //         'gender' => 'required|string|in:laki laki,perempuan',
    //         'pp' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Format gambar yang diizinkan dan ukuran maksimalnya
    //     ]);

    //     // Mengambil data user yang akan diedit
    //     $user = User::findOrFail($id);

    //     // Mengupdate data user sesuai dengan inputan form
    //     $user->name = $request->nama;
    //     $user->alamat = $request->alamat;
    //     $user->no_telp = $request->no;
    //     $user->gender = $request->gender;

    //     // Mengelola file gambar profil (jika ada)
    //     if ($request->hasFile('pp')) {
    //         $image = $request->file('pp');
    //         $imageName = time() . '.' . $image->getClientOriginalExtension();

    //         // Mengompresi gambar sebelum menyimpannya
    //         $compressedImage = Image::make($image)->encode('jpg', 75)->save(public_path('img/avatar/') . $imageName);

    //         // Menyimpan nama file gambar yang telah dikompresi ke dalam model user
    //         $user->avatar = 'img/avatar/' . $imageName;
    //     }

    //     // Menyimpan perubahan pada data user
    //     $user->save();

    //     return redirect()->route('user-edit-profile', $user->id)->with('success', 'Profil berhasil diperbarui');
    // }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rasa;

class RasaController extends Controller
{
    public function index()
    {
        $varians = Rasa::all();

        return view('admin.tampilan.listRasa', compact('varians'))->with('title', 'Bitme | List Rasa');
    }

    public function store(Request $request)
    {
        $request->validate([
            'varian' => 'required|string'
        ]);

        $rasa = new Rasa();
        $rasa->varian_rasa = $request->input('varian');
        $rasa->save();

        return redirect()->back()->with('success', 'Berhasil menambahkan rasa baru');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'varian' => 'required|string'
        ]);

        $rasa = Rasa::findOrFail($id);
        $rasa->varian_rasa = $request->input('varian');
        $rasa->update();

        return redirect()->back()->with('success', 'Berhasil update varian rasa');
    }

    public function destroy($id)
    {
        $rasa = Rasa::findOrFail($id);
        $rasa->delete();

        return redirect()->back()->with('success', 'berhasil menghapus varian rasa');
    }
}

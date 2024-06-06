<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    public function index()
    {
        return view('kategori', [
            'judul' => 'Tabel Kategori',
            'pesan' => 'Kategori',
        ]);
    }

    public function addNewKategori(Request $r)
    {
        // dd($r->nama);
        if ($r->kategoriId == null) {
            $kategori = new Kategori();
            $kategori->nama = $r->nama;
            $kategori->foto = $r->file('foto')->store('public/kategori');
            $kategori->keterangan = $r->keterangan;
            $kategori->save();
        } else {
            $kategori = Kategori::where('id', $r->kategoriId)->first();
            $kategori->nama = $r->nama;

            if ($r->hasFile('foto')) {
                Storage::delete($kategori->foto);
                $foto = $r->file('foto')->store('public/kategori');
            }

            $kategori->foto = $r->hasFile('foto') ? $foto : $kategori->foto;
            $kategori->keterangan = $r->keterangan;
            $kategori->save();
        }

        return redirect('/kategori');
    }

    public function destroy($id)
    {
        $kategori = Kategori::where('id', $id)->first();
        Storage::delete($kategori->foto);
        $kategori->delete();

        return redirect('/kategori');
    }
}

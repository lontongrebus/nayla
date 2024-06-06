<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        return view('barang', [
            'judul' => "Barang",
            'pesan' => "Barang",
        ]);
    }


    public function addNewBarang(Request $r)
    {
        // dd($r);
        if ($r->barangId == null) {
            $barang = new Barang();
            $barang->nama = $r->nama;
            $barang->kode = $r->kode;
            $barang->id_kategori = $r->id_kategori;
            $barang->harga_jual = $r->harga_jual;

            $foto = [];
            foreach ($r->file('foto') as $value) {
                $path = $value->store('public/barang');
                $foto[] = $path;
            }
            $barang->foto = json_encode($foto);
            $barang->save();
        } else {
            $barang = Barang::where('id', $r->barangId)->first();
            $barang->nama = $r->nama;
            $barang->kode = $r->kode;
            $barang->id_kategori = $r->id_kategori;
            $barang->harga_jual = $r->harga_jual;
            if ($r->hasFile('foto')) {
                foreach (json_decode($barang->foto) as $value) {
                    Storage::delete($value);
                }

                $foto = [];
                foreach ($r->file('foto') as $value) {
                    $path = $value->store('public/barang');
                    $foto[] = $path;
                }
            }

            $barang->foto = $r->hasFile('foto') ? $foto : $barang->foto;
            $barang->save();
        }

        return redirect('/barang');
    }

    public function destroy($id)
    {
        $barang = Barang::where('id', $id)->first();
        foreach (json_decode($barang->foto) as $value) {
            Storage::delete($value);
        }
        $barang->delete();

        return redirect('/barang');
    }

    public function detail($id)
    {
        return view('detailproduct')->with('id', $id);
    }
}

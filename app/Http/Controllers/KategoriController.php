<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function kategori()
    {
        $datas = Kategori::all();
        $no = 1;
        return view('kategori', compact('datas', 'no'));
    }

    public function tambahkategori(Request $request)
    {
        $requests = $request->all();
        Kategori::create($requests);
        return redirect()->route('kategori')->with('success', 'Data Kategori Berhasil Ditambahkan');
    }

    public function editkategori(Request $request)
    {
        $data = Kategori::find($request->id);
        $data->update($request->all());
        return redirect()->route('kategori')->with('success', 'Data Kategori Berhasil Diubah');
    }

    public function hapuskategori($id)
    {
        $data = Kategori::find($id);
        $data->delete();
        return redirect()->route('kategori')->with('success', 'Data Kategori Berhasil Dihapus');
    }
}

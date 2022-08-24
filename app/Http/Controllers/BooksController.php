<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Http\Request;


class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function buku(Request $request)
    {
        $data = Books::join('kategori', 'kategori.id', '=', 'books.kategori')
            ->join('rak', 'rak.id', '=', 'books.rak')
            ->select('books.*', 'books.id as b_id', 'kategori.*', 'kategori.id as k_id', 'rak.*', 'rak.id as r_id')
            ->get();
        $kategori = Kategori::all();
        $rak = Rak::all();


        return view('buku', compact('data', 'kategori', 'rak'));
    }

    public function tambahbuku()
    {
        $data = Books::join('kategori', 'kategori.id', '=', 'books.kategori')
            ->join('rak', 'rak.id', '=', 'books.rak')
            ->select('books.*', 'books.id as b_id', 'kategori.*', 'kategori.id as k_id', 'rak.*', 'rak.id as r_id')
            ->first();
        $kategori = Kategori::all();
        $rak = Rak::all();
        return view('tambahbuku', compact('data', 'kategori', 'rak'));
    }
    public function insertbuku(Request $request)
    {
        $data = Books::create($request->all());
        if ($request->hasFile('sampul')) {
            $request->file('sampul')->move('fotosampul/', $request->file('sampul')->getClientOriginalName());
            $data->sampul = $request->file('sampul')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('buku')->with('success', 'Data Buku Berhasil Ditambahkan');
    }
    public function tampilkanbuku($id)
    {
        $data = Books::where('books.id', $id)
            ->join('rak', 'rak.id', '=', 'books.rak')
            ->join('kategori', 'kategori.id', '=', 'books.kategori')
            ->select('books.*', 'books.id as b_id', 'kategori.*', 'kategori.id as k_id', 'rak.*', 'rak.id as r_id')
            ->first();
        $kategori = Kategori::all();
        $rak = Rak::all();

        return view('tampilbuku', compact('data', 'kategori', 'rak'));
    }
    public function updatebuku(Request $request, $id)
    {
        $data = Books::find($id);
        $data->update($request->all());

        return redirect()->route('buku')->with('success', 'Data Buku Berhasil Diupdate');
    }
    public function deletebuku($id)
    {
        $data = Books::find($id);
        $data->delete();
        return redirect()->route('buku')->with('success', 'Data Buku Berhasil Dihapus');
    }
}

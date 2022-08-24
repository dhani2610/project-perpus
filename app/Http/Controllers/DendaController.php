<?php

namespace App\Http\Controllers;

use App\Models\DataDenda;
use App\Models\Denda;
use Illuminate\Http\Request;

class DendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $datas = Denda::all();
        $datadenda = DataDenda::all();
        $no = 1;
        return view('denda', \compact('datas', 'no', 'datadenda'));
    }
    public function tambahdenda(Request $request)
    {
        $requests = $request->all();
        Denda::create($requests);
        return redirect()->route('denda')->with('success', 'Data denda Berhasil Ditambahkan');
    }

    public function editdenda(Request $request)
    {
        $data = Denda::find($request->id);
        $data->update($request->all());
        return redirect()->route('denda')->with('success', 'Data denda Berhasil Diubah');
    }

    public function hapusdenda($id)
    {
        $data = Denda::find($id);
        $data->delete();
        return redirect()->route('denda')->with('success', 'Data denda Berhasil Dihapus');
    }
}

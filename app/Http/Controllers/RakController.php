<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function rak()
    {
        $datas = Rak::all();
        $no = 1;
        return view('rak', compact('datas', 'no'));
    }

    public function tambahrak(Request $request){
        $requests = $request->all();
        Rak::create($requests);
        return redirect()->route('rak')->with('success', 'Data rak Berhasil Ditambahkan');
    }

    public function editrak(Request $request){
        $data = Rak::find($request->id);
        $data->update($request->all());
        return redirect()->route('rak')->with('success', 'Data rak Berhasil Diubah');
    }

    public function hapusrak($id){
        $data = Rak::find($id);
        $data->delete();
        return redirect()->route('rak')->with('success', 'Data rak Berhasil Dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengunjungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    protected $path = 'gambar/';

    protected function uploadImage($image = null)
    {
        if (!$image) {
            return null;
        }
        $name = date('YmdHis') . '_' . trim(str_replace(' ', '-', $image->getClientOriginalName()));
        $image->move($this->path, $name);
        return $name;
    }

    public function index()
    {
        $datas = Pengunjung::all();
        $no = 1;
        return view('pengunjung', compact('datas', 'no'));
    }

    public function tambahpengunjung(Request $request)
    {
        Pengunjung::create([
            'nama_pengunjung' => $request->nama_pengunjung,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('pengunjung')->with('success', 'Data Pengunjung Berhasil Ditambahkan');
    }

    public function editpengunjung(Request $request)
    {
        Pengunjung::where('id', $request->id)->update([
            'nama_pengunjung' => $request->nama_pengunjung,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('pengunjung')->with('success', 'Data Pengunjung Berhasil Dirubah');
    }

    public function hapuspengunjung(Request $request, $id)
    {
        $user = Pengunjung::find($id);
        $user->delete();
        return redirect()->route('pengunjung')->with('success', 'Data Pengunjung Berhasil Dihapus');
    }
}

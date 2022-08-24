<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Books;
use App\Models\Denda;
use App\Models\DataDenda;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon as SupportCarbon;


class PeminjamanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }

    public function index()
    {
        $no = 1;
        $buku = Books::all();
        $users = User::all();
        if (Auth::user()->role == 'user') {
            $datas = Peminjaman::join('users', 'users.id', '=', 'peminjaman.id_peminjam')
                ->join('books', 'books.id', '=', 'peminjaman.id_buku')
                ->select('peminjaman.*', 'peminjaman.id as p_id', 'users.*', 'users.id as u_id', 'books.*', 'books.id as b_id')
                ->where('id_peminjam',Auth::user()->id)
                ->get();
        } elseif (Auth::user()->role == 'admin') {
            $datas = Peminjaman::join('users', 'users.id', '=', 'peminjaman.id_peminjam')
                ->join('books', 'books.id', '=', 'peminjaman.id_buku')
                ->select('peminjaman.*', 'peminjaman.id as p_id', 'users.*', 'users.id as u_id', 'books.*', 'books.id as b_id')
                ->get();
        }

        return view('peminjaman', compact('buku', 'users', 'datas', 'no'));
    }

    public function cekpeminjaman($id)
    {
        $datas = Peminjaman::join('users', 'users.id', '=', 'peminjaman.id_peminjam')
            ->join('books', 'books.id', '=', 'peminjaman.id_buku')
            ->join('rak', 'rak.id', '=', 'books.rak')
            ->join('kategori', 'kategori.id', '=', 'books.kategori')
            ->select('peminjaman.*', 'peminjaman.id as p_id', 'users.*', 'users.id as u_id', 'books.*', 'books.id as b_id', 'kategori.*', 'rak.*')
            ->where('peminjaman.id', $id)
            ->first();

        $datework = Carbon::parse($datas->tanggal_pinjam);
        $dateline = Carbon::parse($datas->tanggal_kembali);

        $now = ($datas->tanggal_pengembalian) ? Carbon::parse($datas->tanggal_pengembalian) : now();

        $diff = ($datework->diffInDays($now) == 0) ? 1 : $datework->diffInDays($now);

        $lama_keterlambatan = 0;

        $dendanya = 0;
        $jenisnya = '';
        if ($now > $datas->tanggal_kembali) {
            $dayLate = $dateline->diffInDays($now);
            $lama_keterlambatan = ($datas->tanggal_pengembalian) ? Carbon::parse($datas->tanggal_pengembalian)->diffInDays($dateline) : 0;
            // dd($dayLate);
            $denda = Denda::where('nama_denda', 'Denda Keterlambatan')->first();
            $dendanya = $this->rupiah($denda->jumlah_denda * $dayLate);
            $jenisnya = $denda->nama_denda;
        }
        // dd($datas);
        return view('cek_pinjaman', compact('datas', 'diff', 'lama_keterlambatan', 'dendanya', 'jenisnya'));
    }



    public function pinjamlist()
    {
        $no = 1;
        $buku = Books::all();
        $users = User::all();
        
        $datas = Peminjaman::join('users', 'users.id', '=', 'peminjaman.id_peminjam')
            ->join('books', 'books.id', '=', 'peminjaman.id_buku')
            ->select('peminjaman.*', 'peminjaman.id as p_id', 'users.*', 'users.id as u_id', 'books.*', 'books.id as b_id')
            ->where('peminjaman.id_peminjam', Auth::user()->id)
            ->get();
        return view('listpinjam', compact('buku', 'users', 'datas', 'no'));
    }


    public function pinjam(Request $request)
    {
        $search = $request->input('search');
        $data = [];

        if ($search) {
            $buku = Books::all();
            $users = User::all();   
            $data = Books::join('kategori', 'kategori.id', '=', 'books.kategori')
                ->join('rak', 'rak.id', '=', 'books.rak')
                ->select('books.*', 'books.id as b_id', 'kategori.*', 'kategori.id as k_id', 'rak.*', 'rak.id as r_id','')
                ->where('books.judul', 'LIKE', "%{$search}%")
                ->get();
        } else {
            $buku = Books::all();
            $users = User::all();       
            $data = Books::join('kategori', 'kategori.id', '=', 'books.kategori')
                ->join('rak', 'rak.id', '=', 'books.rak')
                ->select('books.*', 'books.id as b_id', 'kategori.*', 'kategori.id as k_id', 'rak.*', 'rak.id as r_id')
                ->get();
        }

        return view('pinjam', compact('data','buku','users'));
    }

    public function tambahpeminjaman(Request $request)
    {
        $requests = $request->all();
        // dd($requests);
        Peminjaman::create($requests);
        return redirect()->route('peminjaman')->with('success', 'Data Peminjaman Berhasil Ditambahkan');
    }
       

    public function tambahpinjam(Request $request)
    {
        $requests = $request->all();
        Peminjaman::create($requests);
        return redirect()->route('pinjamlist')->with('success', 'Data Peminjaman Berhasil Ditambahkan');
    }

    public function editpeminjaman(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = Peminjaman::find($request->id);
        $data->status = 1;
        $data->tanggal_pengembalian = date('Y-m-d');
        $data->update();


        $peminjaman = Peminjaman::join('users', 'users.id', '=', 'peminjaman.id_peminjam')
            ->join('books', 'books.id', '=', 'peminjaman.id_buku')
            ->select('peminjaman.*', 'peminjaman.id as p_id', 'users.*', 'users.id as u_id', 'books.*', 'books.id as b_id')
            ->where('peminjaman.id', $request->id)
            ->first();

        // Hitung jumlah denda, rumusnya jumlah hari keterlambatan * denda per hari
        $konfig = Denda::all()->first();
        $due_at = Carbon::parse($peminjaman->tanggal_kembali);
        $returned_at = Carbon::parse($peminjaman->tanggal_pengembalian);

        if (now() > $due_at && now()->diffInDays($due_at) >= 1) {
            $diff = now()->diffInDays($due_at);
            $jumlah_denda = $diff * $konfig->jumlah_denda;

            $datadenda = DataDenda::create([
                'nama_anggota' => $peminjaman->name,
                'jumlah_denda' => $jumlah_denda
            ]);
        }

        return redirect()->route('peminjaman')->with('success', 'Proses Pengembalian Berhasil');
    }

    public function editpinjam(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = Peminjaman::find($request->id);
        $data->status = 1;
        $data->tanggal_pengembalian = date('Y-m-d');
        $data->update();
        return redirect()->route('pinjamlist')->with('success', 'Proses Pengembalian Berhasil');
    }

    public function hapuspeminjaman($id)
    {
        $data = Peminjaman::find($id);
        $data->delete();
        return redirect()->route('peminjaman')->with('success', 'Data Peminjaman Berhasil Dihapus');
    }

    public function exportpdf(Request $request)
    {
        $datas = Peminjaman::join('users', 'users.id', '=', 'peminjaman.id_peminjam')
            ->join('books', 'books.id', '=', 'peminjaman.id_buku')
            ->select('peminjaman.*', 'peminjaman.id as p_id', 'users.*', 'users.id as u_id', 'books.*', 'books.id as b_id')
            ->whereMonth('tanggal_pinjam', $request->bulan)
            ->get();
        // dd($datas);

        view()->share('datas', $datas);
        $pdf = Pdf::loadview('peminjaman-pdf');
        return $pdf->download('datapeminjaman.pdf');
    }

    public function datadendapdf(Request $request)
    {

        $datadenda = DB::table('data_denda')
            ->whereMonth('created_at', $request->bulan)
            ->get();

        view()->share('datadenda', $datadenda);
        $pdf = Pdf::loadview('datadenda-pdf');
        return $pdf->download('datadenda.pdf');
    }
}

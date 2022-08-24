<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $user = User::count();
            $buku = Books::count();
            $pinjam = Peminjaman::count();
            $pengembalian = Peminjaman::where('status', 1)->count();
            return view('dashboard', compact('user', 'buku', 'pinjam', 'pengembalian'));
        } else if (Auth::user()->role == 'user') {
            $pinjam = Peminjaman::where('id_peminjam', Auth::user()->id)->count();
            $pengembalian = Peminjaman::where([
                ['id_peminjam', Auth::user()->id],
                ['status', 1]
            ])->count();
            return view('dashboard', compact('pinjam', 'pengembalian'));
        }
    }
}

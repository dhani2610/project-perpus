<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index()
    {
        $datas = User::where('approval','Pending')->paginate(15);

        $no = 1;
        return view('approval-user.index', compact('datas', 'no'));
    }

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->approval = 'Approve';
        $user->save();
        return redirect()->route('approval-list')->with(['success' => 'Status Persetujuan Registrasi dengan Setuju Berhasil di Ubah!']);
    }

    public function notApprove($id)
    {
        $user = User::findOrFail($id);
        $user->approval = 'Not Approve';
        $user->save();

        return redirect()->route('approval-list')->with(['success' => 'Status Persetujuan Registrasi dengan Tidak Setuju Berhasil di Ubah!']);
    }
    
    public function approvalPeminjamanList()
    {
        $no = 1;
        $buku = Books::all();
        $users = User::all();
        
        $datas = Peminjaman::join('users', 'users.id', '=', 'peminjaman.id_peminjam')
            ->join('books', 'books.id', '=', 'peminjaman.id_buku')
            ->select('peminjaman.*', 'peminjaman.id as p_id', 'users.*', 'users.id as u_id', 'books.*', 'books.id as b_id')
            ->get();

            return view('approval-peminjaman.index', compact('buku', 'users', 'datas', 'no'));
        }
        
        public function approvePeminjaman(Request $request)
        {
            try {
                $id = $request->idPeminjam;
                $peminjaman = Peminjaman::findOrFail($id);
                $peminjaman->approval_peminjaman = 'Approve';
                $peminjaman->pesan = $request->pesan ;
                $peminjaman->save();
                return redirect()->back()->with(['success' => 'Status Persetujuan Peminjaman Berhasil di Ubah!']);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['failed' => $th->getMessage()]);
            }
        }

        public function notApprovePeminjaman(Request $request)
        {
            try {
                $id = $request->idPeminjam;
                $peminjaman = Peminjaman::findOrFail($id);
                $peminjaman->approval_peminjaman = 'Not Approve';
                $peminjaman->pesan = $request->pesan ;
                $peminjaman->save();
                return redirect()->back()->with(['success' => 'Status Persetujuan Peminjaman Berhasil di Ubah!']);
            } catch (\Throwable $th) {
                return redirect()->back()->with(['failed' => $th->getMessage()]);
            }
        }
     
    }



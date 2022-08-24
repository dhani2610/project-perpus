<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
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

    public function loginproses(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $user = User::where('email',$request->email)->first();
            if ($user->approval == 'Pending') {
                return redirect()->route('login')->with(['warning' => 'Akun mu Masih Proses Persetujuan Oleh Admin ']);
            }elseif ($user->approval == 'Not Approve') {
                return redirect()->route('login')->with(['failed' => 'Maaf Registrasi Akun mu Ditolak Oleh Admin']);
            }else {
                return redirect('/');
            }
        }

        return back()->with('loginerror', 'Email & Password yang Anda Masukkan Salah!');
    }

    
    public function logout()
    {
        Auth::logout();
        return \redirect('login');
    }
}

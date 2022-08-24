<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $datas = User::where('approval','Approve')->paginate(15);
        $no = 1;
        return view('user', compact('datas', 'no'));
    }

    public function tambahuser(Request $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'approval' => 'Approve',
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'profile_pict' => $this->uploadImage($request->image)
            ]);
            return redirect()->route('user')->with('success', 'Data User Berhasil Ditambahkan');
        } catch (\Throwable $th) {
        }
    }

    public function edituser(Request $request)
    {
        if ($request->password) {
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'approval' => $request->approval,
                'alamat' => $request->alamat,
                'password' => Hash::make($request->password),
                'role' => $request->role
            ]);
        } else {
            User::where('id', $request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'tempat_lahir' => $request->tempat_lahir,
                'approval' => $request->approval,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'role' => $request->role
            ]);
        }

        return redirect()->route('user')->with('success', 'Data User Berhasil Dirubah');
    }

    public function hapususer(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user')->with('success', 'Data User Berhasil Dihapus');
    }

    public function cetakuser($id)
    {
        $user = User::find($id);
        return view('cetakuser', compact('user'));
    }
}

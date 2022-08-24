<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
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

    public function registeruser(Request $request)
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'approval' => $request->approval,
                'alamat' => $request->alamat,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'profile_pict' => $this->uploadImage($request->image)
            ]);

            return redirect()->route('login')->with('success', 'Berhasil Registrasi,Silahkan tunggu admin menyetujui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed',$th->getMessage());
        }

    }

    // public function store(Request $request)
    // {
    //     try {
    //         // dd($request->all());
    //         $validateData = $request->validate([
    //             'name'   => 'required|string|min:3',
    //             'email'   => 'required|email|unique:users,email',
    //             'password' => 'required|min:8',
    //             'tempat_lahir' => 'required',
    //             'tanggal_lahir' => 'required',
    //             'approval' => 'required',
    //             'alamat' => 'required',
    //             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    //             'role' => 'required',
    //         ]);
    
    //         $user = new User();
    //         $user->name = $validateData['name'];
    //         $user->email = $validateData['email'];
    //         $user->tempat_lahir = $validateData['tempat_lahir'];
    //         $user->tanggal_lahir = $validateData['tanggal_lahir'];
    //         $user->approval = $validateData['approval'];
    //         $user->alamat = $validateData['alamat'];
    //         $user->role = $validateData['role'];
    //         $user->password = Hash::make($validateData['password']);
    //         $user->profile_pict = $this->uploadImage($validateData['image']);
    //         $user->save();
    
    //         return redirect()->route('login')->with(['success' => 'User added successfully!']);
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with(['failed' => $th->getMessage()]);
    //     }
    // }

}

<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pengguna,email',
            'no_hp' => 'required',
            'alamat' => 'required',
            'role' => 'required|in:pembeli,penjual',
            'password' => 'required|min:6|confirmed',
        ]);
        
        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $pengguna = Pengguna::where('email', $request->email)->first();

        if (!$pengguna) {
            return back()->withErrors([
                'email' => 'Email tidak ditemukan.'
            ])->withInput();
        }

        if (!Hash::check($request->password, $pengguna->password)) {
            return back()->withErrors([
                'password' => 'Password salah.'
            ])->withInput();
        }

        session([
            'id_pengguna' => $pengguna->id_pengguna,
            'nama' => $pengguna->nama,
            'email' => $pengguna->email,
            'role' => $pengguna->role,
        ]);

        if ($pengguna->role === 'admin') {
            return redirect('/dashboard-admin');
        }

        if ($pengguna->role === 'penjual') {
            return redirect('/dashboard-penjual');
        }

        return redirect('/dashboard');
    }

}


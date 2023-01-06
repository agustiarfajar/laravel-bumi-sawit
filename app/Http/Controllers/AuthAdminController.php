<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Pesanan;
use DB;
use Session;

session_id("bumi-sawit-admin");
session_start();

class AuthAdminController extends Controller
{
    public function showLogin()
    {
        return view('admin/pages/login');
    }

    public function doLogin(Request $request)
    {
        // Validate form
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $param = $request->only(['email', 'password']);
        // select credentials to login
        $result = User::where('email', $param['email'])->first();

        if($result)
        {                   
           if($result->role == 'admin')
           {
                if(Hash::check($param['password'], $result['password']))
                {
                    if(Auth::attempt($param))
                    {
                        $user = Auth::user();
                        // SET SESSION
                        Session::put('login_admin', true);
                        Session::put('id_user_admin', $result['id']);
                        Session::put('nama_admin', $result['nama']);
                        Session::put('password_admin', $param['password']);
                        Session::put('no_telp_admin', $result['no_telp']);
                        Session::put('foto_admin', $result['foto']);
                        // END OF SESSION

                        if(isset($request->remember))
                        {
                            // SET COOKIE
                            Cookie::queue('remember_admin', 'remembered', 120);
                            Cookie::queue('id_user_admin', $result['id'], 120);
                            Cookie::queue('email_admin', $result['email'], 120);
                            Cookie::queue('password_admin', $param['password'], 120);
                        }
                        
                        // Redirect pages
                        return Redirect::to('admin/dashboard');
                    }
                } else {
                    return redirect()->to('admin/login')->with('error', 'Email atau Password salah!');  
                }
           } else {
            return redirect()->to('admin/login')->with('error', 'Email atau Password salah!');
           }
        } else {
            return redirect()->to('admin/login')->with('error', 'Email atau Password salah!');
        }
    }

    public function doLogout()
    {
        Session::flush();
        if(Cookie::has('remember_admin') == true)
        {
            Cookie::queue(Cookie::forget('remember_admin'));
            Cookie::queue(Cookie::forget('id_user_admin'));
            Cookie::queue(Cookie::forget('email_admin'));
            Cookie::queue(Cookie::forget('password_admin'));
        }
        return Redirect::to('admin/login');
    }

    public function dashboard()
    {
        $pendapatan = DB::table('pesanan')
                    ->select(DB::raw("SUM(subtotal) as subtotal"))
                    ->first();
        $penjualan = DB::table('pesanan')
                    ->select(DB::raw("COUNT(id) as penjualan"))
                    ->first();
        $produk_kategori = DB::table('produk_kategori')
                    ->select(DB::raw("COUNT(id) as produk_kategori"))
                    ->first();
        $produk = DB::table('produk')
                    ->select(DB::raw("COUNT(id) as produk"))
                    ->first();
        return view('admin.dashboard', compact('pendapatan', 'penjualan', 'produk_kategori', 'produk'));
    }

    public function pesanan_user()
    {
        $pesanan = DB::table('pesanan as a')    
        ->join('users as b', 'a.id_user', '=', 'b.id')
        ->select('a.*', 'b.nama as nama_user', 'b.no_telp', 'b.alamat')
        ->orderBy('a.id', 'asc')
        ->get();
        return view('admin.pages.pesanan-user', compact('pesanan'));
    }

    public function update_pesanan($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        if($pesanan)
        {
            $pesanan->update([
                'status' => 'Selesai'
            ]);

            return redirect()->back()->with('success', 'Data berhasil diubah');
        }
    }
}

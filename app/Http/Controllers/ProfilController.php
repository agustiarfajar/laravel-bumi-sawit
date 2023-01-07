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
use Session;
use DB;
session_id("bumi-sawit");
session_start();

class ProfilController extends Controller
{
    public function index()
    {
        $id_user = Session::get('id_user');
        $data = User::where('id', $id_user)->first();

        return view('pages/profil', compact('id_user', 'data'));
    }

    public function ubah_password()
    {
        $id_user = Session::get('id_user');
        $data = User::where('id', $id_user)->first();
        return view('pages.ubahpassword', compact('id_user', 'data'));
    }

    public function update_password(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        $param = $request->all();
        // dd($param['password_lama'] == Session::get('password'));
        $this->validate($request, [
            'password_lama' => ['required', 'string'],
            'password_baru' => ['required', 
                            'string', 
                            'min:6',
                            'regex:/[a-z]/',
                            'regex:/[A-Z]/',
                            'regex:/[0-9]/',
                            'regex:/[@$!%*#?&]/'],
            'konfirmasi_password_baru' => ['required', 'string'],
        ]);

        if($param['password_lama'] == Session::get('password'))
        {
            if($param['konfirmasi_password_baru'] == $param['password_baru'])
            {
                $res = User::where('id', $id)->update([
                    'password' => Hash::make($param['password_baru'])
                ]);
    
                if($res)
                {
                    return redirect()->back()->with('success', 'Ubah Password Berhasil');
                }    
            } else {
                return redirect()->back()->with('error', 'Konfirmasi password salah');
            }
            
        } else {
            return redirect()->back()->with('error', 'Password lama tidak sama');
        }

    }

    public function updateProfil(Request $request, User $user, $id)
    {
        $cek = User::findOrFail($id);    
        $param = $request->all();
        // dd($param);

        $this->validate($request, [
            'email' => ['required', 'string', 'unique:users'.',id,'.$user->id],
        ]);

        if($cek)
        {
            if($request->hasFile('foto'))
            {
                // SETUP STORE IMAGE INTO DATABASE
                $image = $request->file('foto');
                $image->store('assets/uploads/profil', ['disk' => 'public_uploads']);

                //delete old image
                if($cek->foto != null)
                {
                    unlink(public_path('assets/uploads/profil/'.$cek->foto));
                }

                $res = User::where('id', $id)->update([
                    'username' => $param['username'],
                    'nama' => $param['nama'],
                    'email' => $param['email'],
                    'no_telp' => $param['no_telp'],
                    'jk' => $param['jk'],
                    'tgl_lahir' => date('Y-m-d', strtotime($param['tgl_lahir'])),
                    'alamat' => $param['alamat'],
                    'foto' => $image->hashName(),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                Session::put('nama', $param['nama']);
                Session::put('foto', $image->hashName());
            } else {
                $res = User::where('id', $id)->update([
                    'username' => $param['username'],
                    'nama' => $param['nama'],
                    'email' => $param['email'],
                    'no_telp' => $param['no_telp'],
                    'jk' => $param['jk'],
                    'tgl_lahir' => date('Y-m-d', strtotime($param['tgl_lahir'])),
                    'alamat' => $param['alamat'],
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

                Session::put('nama', $param['nama']);
            }

            return redirect()->to('profil')->with('success', 'Data berhasil diubah');
        }
    }

    public function pesanan()
    {
        $id_user = Session::get('id_user');
        $data = User::where('id', $id_user)->first();

        $pesanan = Pesanan::where('id_user', $id_user)->get();

        // $pesanan_detail = DB::table('pesanan as a')
        //         ->join('pesanan_detail as b', 'a.id', '=', 'b.id_pesan')
        //         ->join('produk as c', 'b.id_produk', '=', 'c.id')
        //         ->join('users as d', 'a.id_user', '=', 'd.id')
        //         ->select('a.*','b.harga','b.qty','b.total','c.nama as nama_produk','c.foto')               
        //         ->where('a.id_user', $id_user)
        //         ->get();

        return view('pages.pesanan', compact('id_user', 'data', 'pesanan'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\User;
use Session;

session_id("bumi-sawit");
session_start();

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('pages/register');
    }

    public function doRegister(Request $request)
    {
        $param = $request->all();

        $this->validate($request, [
            'username'  => ['required', 'string', 'max:255'],
            'no_telp'  => ['required', 'numeric'],
            'email' => ['required', 'string', 'unique:users', 'max:255'],
            'password' => ['required', 
                            'string', 
                            'min:6',
                            'regex:/[a-z]/',
                            'regex:/[A-Z]/',
                            'regex:/[0-9]/',
                            'regex:/[@$!%*#?&]/'],
            'konfirmasi_password' => ['required', 'string']
        ]);

        if($param['konfirmasi_password'] == $param['password'])
        {
            $register = User::create([
                'username' => $param['username'],
                'no_telp' => $param['no_telp'],
                'email' => $param['email'],
                'password' => Hash::make($param['password']),
                'nama' => Str::random(10),
                'created_at' => date('Y-m-d H:i:s')          
            ]);
    
            if($register)
            {
                return redirect()->to('login')->with('success', 'Registrasi akun berhasil');
            } else {
                return redirect()->to('login')->with('error', 'Registrasi akun gagal');
            }
        } else {
            return redirect()->to('login')->with('error', 'Registrasi akun gagal! Password tidak sama');
        }
    }

    public function showLogin()
    {
        return view('pages/login');
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
            if($result->role == 'user')
            {
                if(Hash::check($param['password'], $result['password']))
                {
                    if(Auth::attempt($param))
                    {
                        $user = Auth::user();
                        // SET SESSION
                        Session::put('login', true);
                        Session::put('id_user', $result['id']);
                        Session::put('nama', $result['nama']);
                        Session::put('password', $param['password']);
                        Session::put('no_telp', $result['no_telp']);
                        Session::put('foto', $result['foto']);
                        // END OF SESSION

                        if(isset($request->remember))
                        {
                            // SET COOKIE
                            Cookie::queue('remember', 'remembered', 120);
                            Cookie::queue('id_user', $result['id'], 120);
                            Cookie::queue('email', $result['email'], 120);
                            Cookie::queue('password', $param['password'], 120);
                        }
                        
                        // Redirect pages
                        return Redirect::to('/');
                    }
                } else {
                    return redirect()->to('login')->with('error', 'Email atau Password salah!');  
                }
            } else {
                return redirect()->to('login')->with('error', 'Email atau Password salah!');
            }
        } else {
            return redirect()->to('login')->with('error', 'Email atau Password salah!');
        }
    }

    public function doLogout()
    {
        Session::flush();
        if(Cookie::has('remember') == true)
        {
            Cookie::queue(Cookie::forget('remember'));
            Cookie::queue(Cookie::forget('id_user'));
            Cookie::queue(Cookie::forget('email'));
            Cookie::queue(Cookie::forget('password'));
        }
        return Redirect::to('/login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\ProdukKategori;
use App\Models\Produk;
use Validator;
use Session;
use DB;

session_id("bumi-sawit-admin");
session_start();

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = DB::table('produk as a') 
                ->join('produk_kategori as b', 'a.id_kategori', '=', 'b.id')
                ->select('a.*', 'b.nama as kategori')
                ->get();

        return view('admin.pages.produk', compact('produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = ProdukKategori::get();
        return view('admin.pages.produk_tambah', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'nama' => ['required', 'string', 'unique:produk'],
            'id_kategori' => 'required',
            'stok' => ['required', 'numeric', 'min:1'],
            'harga' => ['required', 'numeric', 'min:1'],
            'diskon' => ['numeric', 'min:0', 'max:100'],
            'detail' => ['required', 'string'],
            'spesifikasi' => ['required', 'string'],
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $param = $request->all();       

        if($request->hasFile('foto'))
        {
            $image = $param['foto'];
            $name = time().rand(1,100).'.'.$image->extension();
            $image->move(public_path('assets/uploads/produk'), $name);  
            $foto_produk = $name;    
            
            $produk = Produk::create([
                'nama' => $param['nama'],
                'id_kategori' => $param['id_kategori'],
                'slug' => Str::slug($param['nama']),
                'stok' => $param['stok'],
                'harga' => $param['harga'],
                'detail' => $param['detail'],
                'spesifikasi' => $param['spesifikasi'],
                'diskon' => $param['diskon'],
                'jenis' => $param['jenis'],
                'foto' => $foto_produk,
                'id_user' => Session::get('id_user_admin'),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect('admin-produk')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = ProdukKategori::get();
        $produk = DB::table('produk as a') 
                ->join('produk_kategori as b', 'a.id_kategori', '=', 'b.id')
                ->select('a.*', 'b.nama as kategori')
                ->where('a.id', $id)
                ->first();
        return view('admin.pages.produk_ubah', compact('produk', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk, $id)
    {
        // dd($request->all());
        $param = $request->all();
        $cek = Produk::findOrFail($id);    

        $this->validate($request, [
            'nama' => ['required', 'string', 'unique:produk'.',id,'.$produk->id],
            'id_kategori' => 'required',
            'stok' => ['required', 'numeric', 'min:1'],
            'harga' => ['required', 'numeric', 'min:1'],
            'diskon' => ['numeric', 'min:0', 'max:100'],
            'detail' => ['required', 'string'],
            'spesifikasi' => ['required', 'string'],
        ]);

        if($request->hasFile('foto'))
        {
            $image = $param['foto'];
            $name = time().rand(1,100).'.'.$image->extension();
            $image->move(public_path('assets/uploads/produk'), $name);  
            $foto_produk = $name;
            
            if($cek->foto != null)
            {
                unlink(public_path('assets/uploads/produk/'.$cek->foto));
            }

            Produk::where('id', $id)->update([
                'nama' => $param['nama'],
                'id_kategori' => $param['id_kategori'],
                'slug' => Str::slug($param['nama']),
                'stok' => $param['stok'],
                'harga' => $param['harga'],
                'detail' => $param['detail'],
                'spesifikasi' => $param['spesifikasi'],
                'diskon' => $param['diskon'],
                'jenis' => $param['jenis'],
                'foto' => $foto_produk,
                'id_user' => Session::get('id_user_admin'),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            Produk::where('id', $id)->update([
                'nama' => $param['nama'],
                'id_kategori' => $param['id_kategori'],
                'slug' => Str::slug($param['nama']),
                'stok' => $param['stok'],
                'harga' => $param['harga'],
                'detail' => $param['detail'],
                'spesifikasi' => $param['spesifikasi'],
                'diskon' => $param['diskon'],
                'jenis' => $param['jenis'],
                'id_user' => Session::get('id_user_admin'),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect('admin-produk')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek = Produk::findOrFail($id);
        
        if($cek)
        {
            if($cek->foto != null)
            {
                unlink(public_path('assets/uploads/produk/'.$cek->foto));
            }

            Produk::where('id', $id)->delete();
            return redirect()->to('admin-produk')->with('success', 'Data berhasil dihapus');
        }
    }
}

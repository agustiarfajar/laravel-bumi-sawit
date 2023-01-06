<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use App\Models\ProdukKategori;
use Session;

session_id("bumi-sawit-admin");
session_start();


class ProdukKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = ProdukKategori::get();
        $i = 1;
        return view('admin.pages.produk_kategori', compact('kategori', 'i'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param = $request->all();
        // dd($param);
        $this->validate($request, [
            'nama' => ['required', 'string', 'max:255'],
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // SETUP STORE IMAGE INTO DATABASE
        $image = $request->file('foto');
        $image->store('assets/uploads/produk-kategori', ['disk' => 'public_uploads']);

        $res = ProdukKategori::create([
            'nama' => $param['nama'],
            'foto' => $image->hashName(),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('admin-produk-kategori')->with('success', 'Data berhasil ditambahkan');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => ['required', 'string', 'max:255'],
        ]);

        $param = $request->all();
        $id = $param['id_kategori'];

        $cek = ProdukKategori::findOrFail($id);
        if($cek)
        {
            if($request->hasFile('foto'))
            {
                // SETUP STORE IMAGE INTO DATABASE
                $image = $request->file('foto');
                $image->store('assets/uploads/produk-kategori', ['disk' => 'public_uploads']);

                //delete old image
                if($cek->foto != null)
                {
                    unlink(public_path('assets/uploads/produk-kategori/'.$cek->foto));
                }

                ProdukKategori::where('id', $id)->update([
                    'nama'  => $param['nama'],
                    'foto' => $image->hashName(),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            } else {
                ProdukKategori::where('id', $id)->update([
                    'nama'  => $param['nama'],
                    'updated_at' => date('Y-m-d H:i:s')
                ]);  
            }

            return redirect()->to('admin-produk-kategori')->with('success', 'Data berhasil diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek = ProdukKategori::findOrFail($id);
        if($cek)
        {
            //delete old image
            if($cek->foto != null)
            {
                unlink(public_path('assets/uploads/produk-kategori/'.$cek->foto));
            }
           
            ProdukKategori::where('id', $id)->delete();

            return redirect()->to('admin-produk-kategori')->with('success', 'Data berhasil dihapus');
        }
    }
}

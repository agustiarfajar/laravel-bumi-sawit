<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProdukKategori;
use App\Models\Produk;
use App\Models\Pesanan;
use DB;
use Session;

session_id('bumi-sawit');
session_start();

class HomeController extends Controller
{
    public function index()
    {
        $kategori = ProdukKategori::get();
        $top_sale = ProdukKategori::paginate(12);
        $produk = Produk::paginate($perPage = 16, $columns = ['*'], $pageName = 'produk');
        $produk_favorit = Produk::where('jenis', 'favorit')->paginate(12);
        $produk_diskon  = Produk::where('diskon', '>', 0)->paginate(12);
        $produk_unggulan = Produk::where('jenis', 'unggulan')->orderBy('id', 'desc')->paginate(4);
        return view('home', compact('kategori', 'produk', 'produk_favorit', 'produk_diskon', 'produk_unggulan', 'top_sale'));
    }

    public function tentang()
    {
        return view('pages.tentang');
    }

    public function kontak()
    {
        return view('pages.kontak');
    }

    public function produk()
    {
        $kategori = ProdukKategori::get();
        $produk = Produk::paginate(24);
        $produk_favorit = Produk::where('jenis', 'favorit')->paginate(24);
        $produk_diskon  = Produk::where('diskon', '>', 0)->paginate(24);
        $produk_unggulan = Produk::where('jenis', 'unggulan')->paginate(24);

        return view('pages.produk', compact('kategori', 'produk', 'produk_favorit', 'produk_diskon', 'produk_unggulan'));    
    }

    public function detail_produk($slug)
    {
        $kategori = ProdukKategori::get();
        $produk = Produk::where('slug', $slug)->first();
        $produk_unggulan = Produk::where('jenis', 'unggulan')->paginate(12);
        $produk_terkait = Produk::where('id_kategori', $produk->id_kategori)->orderBy('id', 'desc')->take(4)->get();

        return view('pages.produk_detail', compact('kategori', 'produk', 'produk_terkait', 'produk_unggulan'));
    }

    public function produk_by_kategori($id)
    {
        $kategori = ProdukKategori::get();
        $produk = Produk::where('id_kategori', $id)->paginate(24);
        $produk_favorit = Produk::where('jenis', 'favorit')->where('id_kategori', $id)->paginate(24);
        $produk_diskon  = Produk::where('diskon', '>', 0)->where('id_kategori', $id)->paginate(24);
        $produk_unggulan = Produk::where('jenis', 'unggulan')->where('id_kategori', $id)->paginate(24);

        return view('pages.produkbykategori', compact('kategori', 'produk', 'produk_favorit', 'produk_diskon', 'produk_unggulan'));
    }

    private function exists($id, $cart)
    {
        // dd($cart);
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id'] == $id) {
                return $i;
            }
        }
        return -1;
    }

    public function addToCart(Request $request, $id)
    {
        $product = DB::select('select * from produk where id='.$id);

        if (!$request->session()->has('cart')) {
            $cart = array();
            array_push($cart, [
                "id" => $product[0]->id,
                "nama" => $product[0]->nama,
                "harga" => $product[0]->harga,
                "foto" => $product[0]->foto,
                "qty" => $request['qty'],
            ]);
            $request->session()->put('cart', $cart);
        } else {
            $cart = $request->session()->get('cart');
            $index = $this->exists($id, $cart);
            if ($index == -1) {
                array_push($cart, [
                    "id" => $product[0]->id,
                    "nama" => $product[0]->nama,
                    "harga" => $product[0]->harga,
                    "foto" => $product[0]->foto,
                    "qty" => $request['qty'],
                ]);
            } else {
                $cart[$index]['qty']++;
            }
            $request->session()->put('cart', $cart);
        }
        Session::flash('success-cart','Produk berhasil ditambah ke keranjang!');
        return redirect()->back();
        
        // $cart = Session::get('cart');
        // $cart[$product[0]->id] = array(
            // "id" => $product[0]->id,
            // "nama" => $product[0]->nama,
            // "harga" => $product[0]->harga,
            // "foto" => $product[0]->foto,
            // "qty" => $request['qty'],
        // );

        // Session::put('cart', $cart);
        // Session::flash('success-cart','Produk berhasil ditambah ke keranjang!');
        // return redirect()->back();
    }

    public function updateCart(Request $request)
    {
        $quantities = $request->input('qty');
        $cart = Session::get('cart');
        // dd($cart);
        for ($i = 0; $i < count($cart); $i++) {
            $cart[$i]['qty'] = $quantities[$i];
        }
     
        Session::put('cart', $cart);
        // foreach ($request->id as $id => $val) 
        // {
        //     if ($val > 0) {
        //         $cart[$id]['qty'] += $request->qty;
        //     } else {
        //         unset($cart[$id]);
        //     }
        // }
        return redirect()->back()->with('success-cart', 'Produk berhasil diupdate');
    }

    public function deleteCart($id, Request $request)
    {
        $cart = $request->session()->get('cart');
        $index = $this->exists($id, $cart);
        unset($cart[$index]);
        
        $request->session()->put('cart', array_values($cart));

        return redirect()->back()->with('success-cart', 'Produk berhasil dihapus');
    }

    public function keranjang()
    {
        
        if(session()->has('cart'))
        {
            $cart = Session::get('cart');
            // dd($cart);
            if(count(Session::get('cart')) == 0)
            {
                Session::forget('cart');
            }

            return view('pages.keranjang', compact('cart'));
        } else {
            return view('pages.keranjang');
        }      
    }

    public function doCheckout(Request $request)
    {
        $id = $request->prodid;

        $product = DB::table('produk')->whereIn('id', $id)->get();
        $cart = array();
        foreach($request->prodnama as $key => $value) {
            array_push($cart, [
                "id" => $request->prodid[$key],
                "nama" => $request->prodnama[$key],
                "harga" => $request->prodharga[$key],
                "qty" => $request->prodqty[$key],
                "foto" => $request->prodfoto[$key],
                "total" => $request->prodtotal[$key]
            ]);
        } 
           
        $cart = $request->session()->put('checkout', $cart);

        return response()->json(['produk' => $cart]); 
    }

    public function checkout()
    {
        $checkout = Session::get('checkout');
        $id_user = Session::get('id_user');
        $user = User::where('id', $id_user)->first();

        // dd($checkout);
        return view('pages.checkout', compact('checkout', 'user'));
    }

    public function save_pesanan(Request $request)
    {
        $param = $request->all();
        $produk = DB::table('produk')->whereIn('id', $param['id_produk'])->get();
        $tgl_pesan = date('Y-m-d H:i:s');

        // Simpan ke tabel pesanan
        $pesanan = Pesanan::create([
            'id_user' => Session::get('id_user'),
            'status' => 'Menunggu Konfirmasi',
            'tgl_pesan' => $tgl_pesan,
            'subtotal' => $param['subtotal'],
            'created_at' => $tgl_pesan,
        ]);

        // End
        $i = 0;
        foreach($produk as $row)
        {
            $data = array(
                'id_pesan' => $pesanan->id,
                'id_produk' => $param['id_produk'][$i],
                'harga' => $param['harga'][$i],
                'qty' => $param['qty'][$i],
                'total' => $param['total'][$i]
            );

            $detail = DB::table('pesanan_detail')->insert($data);
            $i++;
        }

        Session::forget('cart');

        return redirect()->to('pesanan')->with('success', 'Pesanan anda berhasil disimpan');
    }
}

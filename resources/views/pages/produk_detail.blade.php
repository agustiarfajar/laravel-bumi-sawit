@extends('../layout')
@section('slider')
<form action="{{url('add-to-cart', $produk->id)}}" method="post">
@csrf 
<div class="d-flex mt-4">
    <div class=""><img src="{{asset('assets/uploads/produk/'.$produk->foto)}}" width="300" height="300" class="img-fluid rounded"></div>
    <div class="p-3 flex-shrink-1">
        <h1 class="fw-bold">{{ $produk->nama }}</h1>
        <p class="mt-3 fs-3" style="font-weight:500">
            <i class="ri-star-line"></i>
            <i class="ri-star-line"></i>
            <i class="ri-star-line"></i>
            <i class="ri-star-line"></i>
            <i class="ri-star-line"></i>
            <span class="fs-5 ml-4">0.0 (0 Reviews)</span>  
        </p>
       
        <div class="d-flex justify-content-between" style="margin-top:90px">
            <span class="fs-4 fw-bold" style="color:#93AF00;">
            Rp<span class="harga_produk">
            @if($produk->diskon > 0)
            <del class="text-danger">{{number_format($produk->harga,0,',','.')}}</del>                               
            {{number_format($produk->harga - (($produk->harga * $produk->diskon)/100),0,',','.')}}
            @else
            {{$produk->harga}}
            @endif
            </span></span>        
            <input type="hidden" id="harga_produk" name="harga" value="{{$produk->harga}}">
            <!-- <input type="hidden" id="harga_db" name="harga_db" value="{{$produk->harga}}"> -->
                       
            <div class="input-group input-group-sm" style="width:100px">
                <button type="button" class="btn btn-success input-group-text minus">-</button>
                <input type="text" class="form-control text-center count" name="qty" value="1" id="qty" readonly>
                <button type="button" class="btn btn-success input-group-text plus">+</button>
            </div>
        </div>
    </div>
</div>
<div class="mb-4">
    <button type="button" style="width:245px;height:83px;background: rgba(147, 175, 0, 0.25);border-radius: 20px;border:none;color:#93AF00;font-size:25px"><i class="ri-share-fill"></i> Bagikan</ type="button">
    <button type="button" onclick="konfirmasiSimpan()" style="width:425px;height:83px;background: #93AF00;box-shadow: 1px 1px 15px rgba(0, 0, 0, 0.2);border-radius: 20px;border:none;color:#fff;font-size:20px;margin-left:15px">Masukkan Keranjang</button>
</div>
</form>
@stop
@section('content')
<div class="row mt-4">
    <div class="col-3">
        <div class="sbanner" style="position:relative">
            <img src="{{asset('assets/images/sbanner.png')}}" class="img-fluid" width="100%">
            <span style="position:absolute;top:8px;left:16px;color:white">Berkebun itu menyenangkan</span>
            <span style="position:absolute;top:50%;left:16px;color:white;" class="fs-1">Aku Suka <br>Berkebun<br> Kalau Kamu?</span>
        </div>

        <ul class="list-group mt-3">
            <li class="list-group-item" aria-current="true" style="background:#93AF00;color:black;font-size:20px;text-align:center"> PRODUK UNGGULAN</li>
            @forelse($produk_unggulan as $row)
            <a href="{{url('detail-produk', $row->slug)}}" class="list-group-item list-group-item-action">
                <div class="d-flex">
                    <div class="p-2"><img src="{{asset('assets/uploads/produk/'.$row->foto)}}" class="img-fluid img-thumbnail rounded" width="100" height="100"></div>
                    <div class="p-2 flex-shrink-1">
                        <span>{{$row->nama}}</span>
                        <p class="mt-3" style="color:#93AF00;font-weight:500">
                            <small>
                                @if($row->diskon > 0)
                                <del class="text-danger">Rp{{number_format($row->harga,0,',','.')}}</del>                               
                                Rp{{number_format($row->harga - (($row->harga * $row->diskon)/100),0,',','.')}}
                                @else
                                Rp{{number_format($row->harga,0,',','.')}}
                                @endif
                            </small>
                        </p>
                    </div>
                </div>
            </a>
            @empty
            <p>No data available</p>
            @endforelse
        </ul>
    </div>
    <div class="col-9">
        <div style="height:143px;background:rgba(147, 175, 0, 0.25);border: 3px dashed #000000;border-radius: 10px;">
            <div class="d-flex">
                <div class="p-3">
                    <img src="{{asset('assets/images/produk/produk1.png')}}" class="rounded-circle img-fluid img-thumbnail" style="width:100px;height:100px;">
                </div>
                <div class="p-3 flex-shrink-1">
                    <p style="font-size:28px">SOCFINDO_OFFICIAL<br>
                        <span class="fw-bold">Jakarta Pusat</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <h2 class="fw-bold">Detail Barang</h2>
            <p>
                {!!$produk->detail!!}
            </p>
            <h2 class="fw-bold">Spesifikasi Barang</h2>
            <p>
                {!!$produk->spesifikasi!!}
            </p>
        </div>

        <div class="mt-4">
            <div class="p-3" style="height:626px;background:rgba(147, 175, 0, 0.25);border: 3px dashed #000000;border-radius: 10px;">
                <h2 class="p-3 fw-bold">Ulasan Produk</h2>
                <div class="d-flex">
                    <div class="p-3">
                        <img src="{{asset('assets/images/produk/produk1.png')}}" class="rounded-circle img-thumbnail img-fluid">
                    </div>
                    <div class="p-3 flex-shrink-1">
                        <p style="font-size:28px" class="fw-bold">An*******f</p>
                        <p style="font-size:28px">
                            Over all bagus. Kualitas juga oke, sesuai deskripsi. Barang sampai dengan selamat dan pengiriman juga cepat. Pokoknya oke semua. Mantap.
                        </p>
                        <div class="row">
                            <div class="col-3">
                                <img src="{{asset('assets/images/produk/sabun.png')}}" class="img-thumbnail" width="151" height="126">
                            </div>
                            <div class="col-3">
                                <img src="{{asset('assets/images/produk/sabun.png')}}" class="img-thumbnail" width="151" height="126">
                            </div>
                            <div class="col-3">
                                <img src="{{asset('assets/images/produk/sabun.png')}}" class="img-thumbnail" width="151" height="126">
                            </div>
                            <div class="col-3">
                                <img src="{{asset('assets/images/produk/sabun.png')}}" class="img-thumbnail" width="151" height="126">
                            </div>
                        </div>
                    </div>      
                </div>
                <a href="#" class="btn btn-default" style="background: rgba(147, 175, 0, 0.25);width:100%;padding:30px;font-size:30px;color:#93AF00;border-radius:30px">Lihat Ulasan Lainnya</a>
            </div>
        </div>

        <div class="mt-4">
            <div class="d-flex justify-content-between">
                <h2 class="fw-bold">Produk Terkait</h2>
                <a href="#" class="btn btn-outline-success rounded-pill" style="height:40px">Lainnya</a>
            </div>
            <div class="row mt-3">
                @forelse($produk_terkait as $row)
                <div class="col-md-3 mb-4">
                    <a href="{{url('detail-produk', $row->slug)}}" class="text-decoration-none link-dark">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <img src="{{asset('assets/uploads/produk/'.$row->foto)}}" class="img-fluid" style="width:310px;height:200px;">
                                </h6>
                                <h6 class="card-subtitle mb-2 text-muted">{{substr($row->nama, 0, 40)}}</h6>
                                <p class="card-text d-flex justify-content-between" style="color:#93AF00;font-weight:600">
                                    @if($row->diskon > 0)
                                    Rp{{number_format($row->harga - (($row->harga * $row->diskon)/100),0,',','.')}}
                                    <del class="fw-normal text-danger">
                                        Rp{{number_format($row->harga,0,',','.')}} 
                                    </del>
                                    @else
                                    Rp{{number_format($row->harga,0,',','.')}}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <p>
                    No data available
                </p>
                @endforelse
            </div>           
        </div>
    </div>
</div>
@stop
@section('js')
<script>
$(document).ready(function(){
@if(session()->has('success-cart'))
    Swal.fire({
          icon: "success",
          title: "Informasi",
          text: "{{Session::get('success-cart')}}",
      })
@endif

    function maskRupiah(angka) {
    var bilangan = angka;

    var reverse = bilangan.toString().split('').reverse().join(''),
      ribuan  = reverse.match(/\d{1,3}/g);
      ribuan  = ribuan.join('.').split('').reverse().join('');

    // Cetak hasil  
    return ribuan;
  }
    if ($('.count').val() == 1) {
        $('.minus').prop('disabled', true);
    }

    

    var harga_fix = parseInt($('#harga_produk').val());
    var harga_produk = parseInt($('.harga_produk').text());
    var plus_harga = harga_produk;
    var min_harga = harga_produk;
    var qty = 1;

    $('.harga_produk').text(maskRupiah(harga_fix));

    // $('.count').prop('readonly', true);
    $(document).on('click','.plus',function(){
        $('.minus').prop('disabled', false);
        $('.count').val(parseInt($('.count').val()) + 1 );
        $('.count').val();
        // harga_produk += harga_fix;
        // $('.harga_produk').text(maskRupiah(harga_produk));  
        // $('#harga_db').val(harga_produk);   
    });

    $(document).on('click','.minus',function(){
        $('.count').val(parseInt($('.count').val()) - 1 );
        $('.count').val();
        harga_produk -= harga_fix;
        // $('.harga_produk').text(maskRupiah(harga_produk));  
        // $('#harga_db').val(harga_produk)
        
        if ($('.count').val() == 1) {
            $('.minus').prop('disabled', true);
            $('.count').val(1);
        }
    });
});
</script>
@stop
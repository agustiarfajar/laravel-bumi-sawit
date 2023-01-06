@extends('../header')
@section('header-content')
@section('title', 'Keranjang')
<!-- ALERT -->
<?php 
function showError($error)
{   
    ?>
    <div class="toast position-fixed top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <span class="text-danger"><i class="bi bi-square-fill"></i></span>
            <strong class="me-auto">&nbsp;Alert</strong>
            
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php echo $error ?>
        </div>
    </div>
    
<?php
}
function showSuccess($success)
{   
    ?>
    <div class="toast position-fixed top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <span class="text-success"><i class="bi bi-square-fill"></i></span>
            <strong class="me-auto">&nbsp;Alert</strong>
            
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <?php echo $success ?>
        </div>
    </div>
    
<?php
}
?>
<style>
    th,td {
    padding: 10px;
    }
</style>
<!-- END OF ALERT -->
<div class="navigasi" style="border:1px solid #1F9720;">
    <div class="container">
        <ul class="nav nav-pills nav-fill">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/" tabindex="1">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/produk" tabindex="1">Shop</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{url('tentang')}}" tabindex="1">Tentang Kami</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{url('kontak')}}" tabindex="1">Kontak Kami</a>
            </li>
            @if(Session::get('login') == null)

            @else
            <li class="nav-item">
            <div class="d-flex justify-content-between">
                <a href="{{ url('keranjang') }}" class="nav-link fs-5" style="color:#1F9720">
                    <i class="bi bi-cart position-relative">
                    @if(session()->has('cart'))
                        @if(count(Session::get('cart')) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:12px">
                        {{ count(Session::get('cart')) }}
                        @else
                        @endif
                    @endif
                    </i>                
                </a>
                <span class="fs-4">|</span>
                <a href="#" class="nav-link fs-5" style="color:#1F9720"><i class="bi bi-heart"></i></a>
            </div>
            </li>
            @endif
        </ul>
    </div>
</div> 
<div class="container mt-4" style="margin-bottom:320px">
    <h2 align="center" class="mb-3">Keranjang Belanja</h2>
    @if(session()->has('cart'))
    <div class="row mt-4">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <form action="{{url('update-cart')}}" method="post">
                        @csrf
                        <table width="100%" align="center">
                            <tr>
                                <th>#</th>
                                <th width="100">Foto</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th width="100">Jumlah</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                            @php 
                                $i=1;
                                $total = 0; 
                            @endphp
                            @forelse($cart as $cart)
                            @php $total += $cart['harga'] * $cart['qty']; @endphp
                            <!-- <input type="text" name="id[]" value="{{ $cart['id'] }}"> -->
                            <tr style="background:#D9D9D9;">
                                <td>
                                    <input type="checkbox" name="check_produk[]" class="form-check-input cek-produk" 
                                    data-id="{{$cart['id']}}" 
                                    data-nama="{{$cart['nama']}}" 
                                    data-harga="{{$cart['harga']}}" 
                                    data-qty="{{$cart['qty']}}"
                                    data-foto="{{$cart['foto']}}">
                                </td>
                                <td>
                                    <img src="{{asset('assets/uploads/produk/'.$cart['foto'])}}" class="img-thumbnail img-fluid" style="width:82px;height:82px">
                                </td>
                                <td>{{ $cart['nama'] }}</td>
                                <td><span class="fw-bold" style="color:#93AF00;font-size:20px">Rp{{ number_format($cart['harga'],0,',','.') }}</span></td>
                                <td>
                                <input type="number" value="{{$cart['qty']}}" min="1" name="qty[]" class="form-control qty">    
                                <!-- <div class="input-group input-group-sm" style="width:100px">
                                        <button type="button" class="btn btn-success input-group-text minus{{$i++}}" data-id="{{$cart['id']}}">-</button>
                                            <input type="text" class="form-control text-center qty" value="{{$cart['qty']}}" id="qty" name="qty[]">
                                        <button type="button" class="btn btn-success input-group-text plus{{$i++}}" data-id="{{$cart['id']}}">+</button>
                                    </div> -->
                                </td>
                                <td>
                                    <span class="fw-bold" style="color:#93AF00;font-size:20px">Rp{{ number_format($cart['harga'] * $cart['qty'],0,',','.') }}</span> 
                                </td>
                                <td>
                                    <a href="{{url('delete-cart/'.$cart['id'])}}" class="btn btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>          
                            </tr>
                            <tr bgcolor="#fff">
                                <td></td>
                            </tr>
                            @empty
                            <p class="text-center">No Data Available</p>
                            @endforelse
                        </table>
                        @if(count(Session::get('cart')) > 0)
                        <button type="button" class="btn btn-primary mt-3" onclick="konfirmasiUbah()">Update Keranjang</button>
                        @else
                        @endif
                        </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <b>Ringkasan Belanja</b>
                    <div class="d-flex justify-content-between mt-3">
                        <span>Total Harga (<span class="jml_barang"></span> Barang)</span>
                        <span>Rp<span class="harga">0</span></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <b>Total Harga</b>
                        <b>Rp<span class="harga">0</span></b>
                    </div>
                    <form>
                        @csrf
                        <input type="submit" id="btnCheckout" class="btn btn-success w-100 mt-3" value="Checkout">
                    </form>
                </div>
            </div>
        </div>
        @else 
        <p class="text-center">No Data Available</p>
        @endif
    </div>
</div>
@stop 
@section('js')
<script>
// Format Rupiah
function maskRupiah(angka) {
var bilangan = angka;
var reverse = bilangan.toString().split('').reverse().join(''),
    ribuan  = reverse.match(/\d{1,3}/g);
    ribuan  = ribuan.join('.').split('').reverse().join('');

// Cetak hasil  
return ribuan;
}

$(document).ready(function(){
@if(session()->has('success-cart'))
    Swal.fire({
          icon: "success",
          title: "Informasi",
          text: "{{Session::get('success-cart')}}",
      })
@endif 
    @if(session()->has('cart'))
    var data = "{{count(Session::get('cart'))}}";
    if(data > 0)
    {
        var qty = 0;
        var total = parseInt("{{$total}}");
        var jml_barang = "{{count(Session::get('cart'))}}";
        var qty = parseInt(jml_barang);

        $('.cek-produk').prop('checked', true);
        $('.jml_barang').text(jml_barang);
        $('.harga').text(maskRupiah(total));

        $('.cek-produk').each(function(){        
            
            var harga = parseInt($(this).data('harga'));
            var jml = parseInt($(this).data('qty'));

            harga = harga * jml;

            $(this).on('click', function(){
                if($(this).is(':checked'))
                {
                    // alert($(this).data('id'));
                    var id = $(this).data('id');
                    qty = qty+1;
                    total = parseInt(total+harga);
                    $('#btnCheckout').prop('disabled', false);
                    $('.jml_barang').text(qty);
                    $('.harga').text(maskRupiah(total));

                } else {
                    qty = qty-1;
                    total = parseInt(total-harga);
                    if(qty == 0)
                    {
                        $('#btnCheckout').prop('disabled', true);
                    }

                    $('.jml_barang').text(qty);
                    $('.harga').text(maskRupiah(total));
                }
            })
        })
    }

    $('#btnCheckout').on('click', function(e){
        e.preventDefault();

        const prodid = [];
        const prodnama = [];
        const prodharga = [];
        const prodqty = [];
        const prodfoto = [];
        const prodtotal = [];

        $('.cek-produk').each(function(){
            if($(this).is(":checked"))
            {
                var id = $(this).data('id');
                var nama = $(this).data('nama');
                var harga = $(this).data('harga');
                var qty = $(this).data('qty');
                var foto = $(this).data('foto');
                var total = harga * qty;

                prodid.push(id);
                prodnama.push(nama);
                prodharga.push(harga);
                prodqty.push(qty);
                prodfoto.push(foto);
                prodtotal.push(total);
            }
        })

        $.ajax({
            url: '{{ url("doCheckout") }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                prodid: prodid,
                prodnama: prodnama,
                prodharga: prodharga,
                prodqty: prodqty,
                prodfoto: prodfoto,
                prodtotal: prodtotal
            },
            success:function(r) {
                window.location.href = "{{url('checkout')}}";
            }
        })
    })
    @endif

});
</script>
@stop
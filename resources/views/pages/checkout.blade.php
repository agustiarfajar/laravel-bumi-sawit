@extends('../header')
@section('header-content')
@section('title', 'Checkout')
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
<div class="container mt-4" style="margin-bottom:320px;">
<h2 align="center" class="mb-3">Checkout Produk</h2>
@if(session()->has('checkout'))
<form action="{{url('save-pesanan')}}" method="post">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="card-title fs-3 fw-semibold">Produk</div>
            @php 
                $total = 0; 
            @endphp
            <table width="100%" align="center">
                @forelse($checkout as $data)
                @php $total += $data['total']; @endphp
                <tr style="background:#D9D9D9;">
                    <input type="hidden" name="id_produk[]" value="{{ $data['id'] }}">
                    <td><img src="{{asset('assets/uploads/produk/'.$data['foto'])}}" class="img-thumbnail img-fluid" style="width:82px;height:82px"></td>
                    <td>{{ $data['nama'] }}</td>
                    <td>
                        <span class="fw-bold" style="color:#93AF00;font-size:20px">Rp{{ number_format($data['harga'],0,',','.') }}</span>
                        <input type="hidden" name="harga[]" value="{{$data['harga']}}">
                    </td>
                    <td>
                        <span class="fw-bold">{{ $data['qty'] }}</span>
                        <input type="hidden" name="qty[]" value="{{$data['qty']}}">
                    </td>
                    <td>
                        <span class="fw-bold" style="color:#93AF00;font-size:20px">Rp{{ number_format($data['total'],0,',','.') }}</span>
                        <input type="hidden" name="total[]" value="{{$data['total']}}">
                    </td>
                </tr>
                <tr bgcolor="#fff">
                    <td></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No Data Available</td>
                </tr>
                @endforelse
            </table>
            <input type="hidden" name="subtotal" value="{{ $total }}">
            <div class="card-title fs-3 fw-semibold">Detail Pembeli</div>
            <div class="d-flex justify-content-between p-3 m-auto" style="background:#D9D9D9;">
                <p><span class="fw-bold">{{ $user->nama }}</span><br>{{ $user->no_telp }}</p>
                <p class="fw-semibold">
                    {{$user->alamat}}
                </p>
            </div>
            <div class="mt-2">
                <button type="button" class="btn btn-success w-100" onclick="konfirmasiSimpan()">Simpan Pesanan</button>
            </div>
        </div>
    </div>
</form>
@endif
</div>
@stop
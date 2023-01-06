@extends('header')
@section('title', 'Bumi Sawit E-Commerce')
@section('header-content')
<div class="container mt-4">
  <div class="row">
    <div class="col-3">
      <div class="list-group">
        <div class="list-group-item" aria-current="true" style="background:#93AF00;color:black;font-size:20px"><i class="bi bi-list"></i> Kategori</div>
        @foreach($kategori as $row)
          <a href="{{url('produk-kategori', $row->id)}}" class="list-group-item list-group-item-action">
            @if($row->nama == 'Benih')
              <img src='{{asset("assets/images/icon/benih.png")}}' width="21px">
            @elseif($row->nama == 'Bibit')
              <img src='{{asset("assets/images/icon/bibit.png")}}' width="21px">
            @elseif($row->nama == 'Alat Tani')
            <img src='{{asset("assets/images/icon/alat-tani.png")}}' width="21px">
            @elseif($row->nama == 'Bahan Konsumsi')
            <img src='{{asset("assets/images/icon/bahan-konsumsi.png")}}' width="21px">
            @elseif($row->nama == 'Sabun')
            <img src='{{asset("assets/images/icon/sabun.png")}}' width="21px">
            @elseif($row->nama == 'Pupuk')
            <img src='{{asset("assets/images/icon/pupuk.png")}}' width="21px">
            @elseif($row->nama == 'Anti Hama')
            <img src='{{asset("assets/images/icon/anti-hama.png")}}' width="21px">
            @elseif($row->nama == 'Penyiraman')
            <img src='{{asset("assets/images/icon/penyiraman.png")}}' width="21px">
            @else 
            <img src='{{asset("assets/images/icon/kategori.png")}}' width="21px">
            @endif
            {{$row->nama}}
          </a>
        @endforeach
      </div>
      @yield('sidebar_unggulan')
    </div>
    <div class="col-9">
      <div class="navigasi" style="border:1px solid #1F9720;">
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
      @yield('slider')
    </div>
  </div>

</div>
<div class="container">
  @yield('content')
</div>
@stop
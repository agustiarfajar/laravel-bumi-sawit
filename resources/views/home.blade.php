@extends('layout')
@section('slider')
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-current="true" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-current="true" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="{{asset('assets/images/slider1.jpg')}}" class="d-block w-100" alt="slider1">
      <div class="carousel-caption d-none d-md-block">
        <p>
            <!-- <a href="#" class="btn btn-success">Lihat Sekarang</a></p> -->
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="{{asset('assets/images/slider2.jpg')}}" class="d-block w-100" alt="slider2">
      <div class="carousel-caption d-none d-md-block">
        <p>
            <!-- <a href="#" class="btn btn-success">Lihat Sekarang</a></p> -->
      </div>
    </div>
    <div class="carousel-item">
      <img src="{{asset('assets/images/slider3.jpg')}}" class="d-block w-100" alt="slider3">
      <div class="carousel-caption d-none d-md-block">
        <p>
            <!-- <a href="#" class="btn btn-success">Lihat Sekarang</a></p> -->
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

@endsection
@section('content')
<div class="mt-4">
    <h2 class="text-center">PRODUK TOP SALE</h2>
    <p class="text-muted text-center">produk produk yang cocok buat kamu</p>

    <div class="row">
        @foreach($top_sale as $row)
        <div class="col-md-3 mb-4">
            <div class="card">
                <a href="#" class="text-decoration-none text-secondary link-success fw-bold">
                    <img src="{{asset('assets/uploads/produk-kategori/'.$row->foto)}}" class="card-img-top img-fluid img-thumbnail" style="width:100%;height:300px;object-fit:cover;object-position:50% 50%">
                    <div class="card-body">
                        <p class="text-center">
                            <span>{{$row->nama}}</span>
                        </p>
                    </div>
                </a>  
            </div>
        </div>
        @endforeach
    </div>
</div>

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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link disabled fw-semibold">PRODUK PILIHAN</a>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" style="color:#1F9720" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">BARU</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" style="color:#1F9720" id="favorit-tab" data-bs-toggle="tab" data-bs-target="#favorit-tab-pane" type="button" role="tab" aria-controls="favorit-tab-pane" aria-selected="false">FAVORIT</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" style="color:#1F9720" id="diskon-tab" data-bs-toggle="tab" data-bs-target="#diskon-tab-pane" type="button" role="tab" aria-controls="diskon-tab-pane" aria-selected="false">LAGI DISKON</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <div class="row mt-4">
                    @forelse($produk as $row)
                    <div class="col-md-3 mb-4">
                        <a href="{{url('detail-produk', $row->slug)}}" class="text-decoration-none link-dark">
                            <div class="card">  
                                <div class="card-body">     
                                    <h6 class="card-title">
                                        <img src="{{asset('assets/uploads/produk/'.$row->foto)}}" class="img-fluid" style="width:310px;height:200px;">
                                    </h6>
                                    <h6 class="card-subtitle mb-2 text-muted">{{substr($row->nama, 0, 40)}}</h6>
                                    <p class="card-text" style="color:#93AF00;font-weight:600">
                                        Rp{{number_format($row->harga,0,',','.')}}
                                    </p>
                                </div>
                            </div>
                        </a>  
                    </div>
                    @empty
                    <p>No data available</p>
                    @endforelse
                    <a href="{{url('produk')}}" class="btn btn-outline-success btn-lg">Lihat Selengkapnya</a>
                </div>
            </div>
            <div class="tab-pane fade" id="favorit-tab-pane" role="tabpanel" aria-labelledby="favorit-tab" tabindex="0">
                <div class="row mt-4">
                    @forelse($produk_favorit as $row)
                    <div class="col-md-3 mb-4">
                        <a href="{{url('detail-produk', $row->slug)}}" class="text-decoration-none link-dark">
                            <div class="card">  
                                <div class="card-body">     
                                    <h6 class="card-title">
                                        <img src="{{asset('assets/uploads/produk/'.$row->foto)}}" class="img-fluid" style="width:310px;height:200px;">
                                    </h6>
                                    <h6 class="card-subtitle mb-2 text-muted">{{substr($row->nama, 0, 40)}}</h6>
                                    <p class="card-text" style="color:#93AF00;font-weight:600">
                                        Rp{{number_format($row->harga,0,',','.')}}
                                    </p>
                                </div>
                            </div>
                        </a>
                        
                    </div>
                    @empty
                    <p>No data available</p>
                    @endforelse
                    <a href="{{url('produk')}}" class="btn btn-outline-success btn-lg">Lihat Selengkapnya</a>
                </div>
            </div>
            <div class="tab-pane fade" id="diskon-tab-pane" role="tabpanel" aria-labelledby="diskon-tab" tabindex="0">
                <div class="row mt-4">
                    @forelse($produk_diskon as $row)
                    <div class="col-md-3 mb-4">
                        <a href="{{url('detail-produk', $row->slug)}}" class="text-decoration-none link-dark">
                            <div class="card">  
                                <div class="card-body">     
                                    <h6 class="card-title">
                                        <img src="{{asset('assets/uploads/produk/'.$row->foto)}}" class="img-fluid" style="width:310px;height:200px;">
                                    </h6>
                                    <h6 class="card-subtitle mb-2 text-muted">{{substr($row->nama, 0, 40)}}</h6>
                                    <p class="card-text d-flex justify-content-between" style="color:#93AF00;font-weight:600">
                                        Rp{{number_format($row->harga - (($row->harga * $row->diskon)/100),0,',','.')}}
                                        <del class="fw-normal text-danger">
                                            Rp{{number_format($row->harga,0,',','.')}} 
                                        </del>         
                                    </p>
                                </div>
                            </div>
                        </a>                  
                    </div>
                    @empty
                    <p>No data available</p>
                    @endforelse
                    <a href="{{url('produk')}}" class="btn btn-outline-success btn-lg">Lihat Selengkapnya</a>

                </div>
            </div>
        </div>
    </div>
</div>
@stop
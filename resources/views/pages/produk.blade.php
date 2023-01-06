@extends('../layout')
@section('sidebar_unggulan')
<div class="sbanner mt-4" style="position:relative">
    <img src="{{asset('assets/images/sbanner.png')}}" class="img-fluid" width="100%">
    <span style="position:absolute;top:8px;left:16px;color:white">Berkebun itu menyenangkan</span>
    <span style="position:absolute;top:50%;left:16px;color:white;" class="fs-1">Aku Suka <br>Berkebun<br> Kalau Kamu?</span>
</div>
@stop
@section('slider')
<div class="mt-4">
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
        </div>
        <div class="d-flex justify-content-center">{!! $produk->links('pagination::bootstrap-4') !!}</div>
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
        </div>
        <div class="d-flex justify-content-center">{{ $produk_favorit->links('pagination::bootstrap-4') }}</div>
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
        </div>
        <div class="d-flex justify-content-center">{{ $produk_diskon->links('pagination::bootstrap-4') }}</div>
    </div> 
</div> 
</div>
@stop
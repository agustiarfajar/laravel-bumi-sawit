@extends('../header')
@section('header-content')
@section('title', 'Tentang Kami')
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
<section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Tentang Kami</h1>
                <p class="lead text-muted">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid nisi eius optio ratione corporis, dolorum neque, illo voluptas non tempore velit fugit dolore commodi recusandae magnam consequuntur aspernatur doloribus nulla.
                </p>
            </div>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-1 mx-3">
                <div class="col">
                    <div class="card" style="width: 15rem;">
                        <img class="card-img-top" src="{{asset('assets/images/sbanner.png')}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Bang Lorem</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum a laboriosam blanditiis illum iure fugit. Aliquid voluptatibus veniam ab. Laboriosam quisquam nobis dolore, perspiciatis autem quidem error in accusantium quos!</p>
                        </div>
                      </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 15rem;">
                        <img class="card-img-top" src="{{asset('assets/images/sbanner.png')}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Bang Lorem</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum a laboriosam blanditiis illum iure fugit. Aliquid voluptatibus veniam ab. Laboriosam quisquam nobis dolore, perspiciatis autem quidem error in accusantium quos!</p>
                        </div>
                      </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 15rem;">
                        <img class="card-img-top" src="{{asset('assets/images/sbanner.png')}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Bang Lorem</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum a laboriosam blanditiis illum iure fugit. Aliquid voluptatibus veniam ab. Laboriosam quisquam nobis dolore, perspiciatis autem quidem error in accusantium quos!</p>
                        </div>
                      </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 15rem;">
                        <img class="card-img-top" src="{{asset('assets/images/sbanner.png')}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Bang Lorem</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum a laboriosam blanditiis illum iure fugit. Aliquid voluptatibus veniam ab. Laboriosam quisquam nobis dolore, perspiciatis autem quidem error in accusantium quos!</p>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
@stop
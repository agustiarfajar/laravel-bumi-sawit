@extends('../header')
@section('header-content')
@section('title', 'Kontak Kami')
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
<div class="container">
    <div class="py-5 text-center">
        <h2>Kontak Kami</h2>
        <p class="lead">Feel free to contact us anytime. We will get back to you as soon as we can!</p>
    </div>
</div>
<div class="container px-5 py-4 bg-white">
    <div class="row g-5">
        <div class="col-md-7 col-lg-8">
            <form action="" class="needs-validation" novalidate>
                <div class="pb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name..." required>
                    <div class="invalid-feedback">
                        Please enter your name.
                    </div>
                </div>
                <div class="pb-3">
                    <label for="email" class="form-label">
                        Email
                        <span class="text-muted">(Optional)</span>
                    </label>
                    <input type="email" class="form-control" placeholder="you@example.com">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>
                <div class="pb-3">
                    <label for="message" class="form-label">Message</label>
                    <input type="text" class="form-control" id="message" placeholder="Enter your message..." required>
                    <div class="invalid-feedback">
                        Please enter your message.
                    </div>
                </div>
                <button class="w-100 btn btn-dark btn-lg" type="submit"> Send</button>
            </form>
        </div>

        <div class="col-md-5 col-lg-4">
            <div class="py-3 mt-4 px-2 bg-light">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="">Info</span>
            </h4>
            <p class="lead">Email : banglorem@gmail.com</p>
            <p class="lead">telp : 0800-0000-0000</p>
            <p class="lead">Alamat : Spanyol without S (panyol)</p>
            <p class="lead">Jam Kerja : 09.00 - 15.00 GMT</p>
            </div>
        </div>
    </div>
</div>
@stop
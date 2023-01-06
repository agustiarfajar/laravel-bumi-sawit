<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Karla' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- JQUERY UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.min.css">
<style>
    body, html {
      height: 100%;
      font-family: 'Karla';
    }

    .navigasi a {
      color: black;
    }
    .navigasi a:hover {
      color: #1F9720;
    }

    .navigasi a:active {
      color: #1F9720;
    }

    .navigasi a[tabindex]:focus {
      color: #1F9720;
    }

    .card {
      box-shadow: 1px 4px 6px rgba(0,0,0,0.5);
    }

    footer {
      background : #000000;
    }
    footer a {
      color: inherit;
      text-decoration: none;
      transition: all 0.3s;
    }

    img {
      max-width: 100%;
      height: auto;
    }

    .login:hover{
      color: #1F9720;
    }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light d-flex justify-content-between">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
          <img src="{{asset('assets/images/3.png')}}" alt="bumi-sawit-3" width="300">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="mt-3" style="width:542px;margin:auto">
              <div class="input-group flex-nowrap">
                <input type="text" class="form-control" placeholder="Search..." aria-describedby="addon-wrapping">
                <button type="button" class="input-group-text" id="addon-wrapping" style="background:#1F9720;color:white">Search</button>
              </div>
            </form>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              @if(Session::get('login') == null)
              <li class="nav-item">
                  <a href="{{url('login')}}" class="login nav-link me-4 fw-bold">Login</a>    
                </li>
                <li class="nav-item">
                  <a href="{{url('register')}}" class="btn btn-success rounded-5" style="width:200px;background:#1F9720">Register</a>    
                </li>
              @else
              <li class="nav-item">
              <div class="dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php $user = Session::get('user') ?>
                  @if(Session::get('foto') == null)
                  <img src="{{asset('assets/images/profile-pict.png')}}" style="width:53px;height:53px;object-fit:cover;object-position:50% 50%;" class="border rounded-circle img-thumbnail img-fluid">
                  @else
                  <img src="{{asset('assets/uploads/profil/'.Session::get('foto'))}}" style="width:53px;height:53px;object-fit:cover;object-position:50% 50%;" class="border rounded-circle img-thumbnail img-fluid">
                  @endif
                  <span class="ms-2 m-auto mt-2" style="font-size:20px">{{ Session::get('nama') }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item" href="{{url('profil')}}">Profil</a></li>
                  <li><a class="dropdown-item" href="{{url('pesanan')}}">Pesanan Saya</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{url('doLogout')}}">Logout <i class="ri-logout-circle-line"></i></a></li>
                </ul>
              </div>
              </li>
              @endif
            </ul>
        </div>
    </div>
</nav>
@yield('header-content')
<!-- FOOTER -->
<div class="d-flex flex-column mt-4">
  <footer class="w-100 py-4 flex-shrink-0">
        <div class="container py-4">
            <div class="row gy-4 gx-5">
                <div class="col-lg-10 col-md-6">
                    <img src="{{asset('assets/images/3-white.png')}}">
                    <p class="small text-muted mt-3">Toko Online perlengkapan pertanian dan perkebunan Terlengkap.</p>
                    <ul class="list-unstyled text-muted">
                        <li><i class="ri-map-pin-line"></i> Jl. Kupu Bombay No.93, RT.01/RW.06, Pasir Putih, Kec. Sawangan, Kota Depok, Jawa Barat 16519</li>
                        <li><i class="ri-smartphone-line"> Phone: 0859-2167-1760</i></li>
                        <li><i class="ri-mail-line"></i> Email: cs@benihkita.com</li>
                    </ul>
                    <!-- <p class="small text-muted mb-0">&copy; Copyrights. All rights reserved. <a class="text-primary" href="#">Bootstrapious.com</a></p> -->
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white mb-3">Link Penting</h5>
                    <ul class="list-unstyled text-muted">
                        <li><a href="#">Kontak Kami</a></li>
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Promo</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.16/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
  // Sweetalert
  function konfirmasiSimpan()
  {
      event.preventDefault();
      var form = event.target.form;
      Swal.fire({
          icon: "question",
          title: "Konfirmasi",
          text: "Apakah anda yakin ingin menyimpan data?",
          showCancelButton: true,
          confirmButtonText: "Simpan",
          cancelButtonText: "Batal"
      }).then((result) => {
          if(result.value) {
              form.submit();
          } else {
              Swal.fire("Informasi","Data batal disimpan","error");
          }
      });
  }
  function konfirmasiUbah()
  {
      event.preventDefault();
      var form = event.target.form;
      Swal.fire({
          icon: "question",
          title: "Konfirmasi",
          text: "Apakah anda yakin ingin mengubah data?",
          showCancelButton: true,
          confirmButtonText: "Ubah",
          cancelButtonText: "Batal"
      }).then((result) => {
          if(result.value) {
              form.submit();
          } else {
              Swal.fire("Informasi","Data batal diubah","error");
          }
      });
  }
  function konfirmasiHapus()
  {
      event.preventDefault();
      var form = event.target.form;
      Swal.fire({
          icon: "question",
          title: "Konfirmasi",
          text: "Apakah anda yakin ingin menghapus data?",
          showCancelButton: true,
          confirmButtonText: "Hapus",
          cancelButtonText: "Batal"
      }).then((result) => {
          if(result.value) {
              form.submit();
          } else {
              Swal.fire("Informasi","Data batal dihapus","error");
          }
      });
  }
  
  // END SWEETALERT
</script>
@yield('js')
</body>
</html>
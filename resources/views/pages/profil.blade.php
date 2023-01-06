@extends('../header')
@section('header-content')
@section('title', 'Profil')
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
<div class="container">
    <div class="row mt-4" style="margin-bottom:100px">
        <div class="col-md-3 mb-3 mt-3">
            <div class="d-flex justify-content-start">
                @if($data->foto != null)
                <a href="{{asset('assets/uploads/profil/'.$data->foto)}}" target="_blank"><img src="{{asset('assets/uploads/profil/'.$data->foto)}}" class="rounded-circle img-thumbnail" style="width:109px;height:109px;object-fit:cover;object-position:50% 50%;"></a>
                @else
                <a href="{{asset('assets/images/profile-pict.png')}}" target="_blank"><img src="{{asset('assets/images/profile-pict.png')}}" class="rounded-circle img-thumbnail" style="width:109px;height:109px;object-fit:cover;object-position:50% 50%;"></a>
                @endif
                <span class="mt-4 fs-5 ms-2">{{ $data->nama }}</span>
            </div>
            <ul class="list-group mt-4">
                <li class="list-group-item" style="border:0">
                    <span class="fw-semibold">Akun Saya</span>
                    <ul class="list-group">
                        <li class="list-group-item text-muted" style="border:0"><a href="{{url('profil')}}" class="link-secondary text-decoration-none fw-semibold">Profil</a></li>
                        <li class="list-group-item text-muted" style="border:0"><a href="{{url('ubah-password')}}" class="link-secondary text-decoration-none">Ubah Password</a></li>
                    </ul>
                </li>
                <li class="list-group-item" style="border:0"><a href="{{url('pesanan')}}" class="link-dark fw-semibold text-decoration-none">Pesanan Saya</a></li>
            </ul>
        </div>
        <div class="col-md-6 mb-3 mt-3">
            <div class="profil-form p-3" style="background:#E4EBBF;">
                <h4>Profil Saya</h4>
                <p class="text-muted">
                    Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun
                </p>
                <form action="{{url('profil-update', $data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(session()->has('error'))
                    <p><?php echo showError(Session::get('error')); ?></p>
                    @elseif(session()->has('success'))
                    <p><?php echo showSuccess(Session::get('success')); ?></p>
                    @endif 
                    <div class="row mb-3">
                        <label for="inputUsername" class="col-sm-3 col-form-label">User Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="username" class="form-control" id="inputUsername" value="{{ $data->username }}" placeholder="Masukkan Username">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control" id="inputNama" value="{{ $data->nama }}" placeholder="Masukkan Username">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" id="inputEmail3" value="{{ $data->email }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNoTelp" class="col-sm-3 col-form-label">Nomor Telepon</label>
                        <div class="col-sm-9">
                            <input type="text" name="no_telp" class="form-control" id="inputNoTelp" value="{{ $data->no_telp }}" maxlength="13" placeholder="Masukkan Nomor Telepon">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputJK" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select name="jk" id="inputJK" class="form-select">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ ($data->jk == 'L' ? 'selected' : '') }}>Laki-laki</option>
                                <option value="P" {{ ($data->jk == 'P' ? 'selected' : '') }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputTglLahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-9">
                            <input type="text" name="tgl_lahir" id="tgl_lahir" class="form-control" id="inputTglLahir" value="{{ ($data->tgl_lahir == null ? '' : date('d/m/Y', strtotime($data->tgl_lahir))) }}" placeholder="Masukkan Tanggal Lahir" autocomplete="off">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputAlamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <textarea name="alamat" id="" cols="30" rows="10" class="form-control">{{ $data->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="button" id="btn-ok" class="btn btn-primary w-100" style="background:#1F9720;border:none">Update</button>
                        </div>
                    </div>
                
            </div>
        </div>
        <div class="col-md-3 mb-3 mt-3">
            <center>
                <div class="mt-4">
                    @if($data->foto != null)
                    <img src="{{asset('assets/uploads/profil/'.$data->foto)}}" id="foto" class="rounded-circle img-thumbnail img-fluid" style="width:167px;height:167px;object-fit:cover;object-position:50% 50%;">
                    @else
                    <img src="{{asset('assets/images/profile-pict.png')}}" id="foto" class="rounded-circle img-thumbnail img-fluid" style="width:167px;height:167px;object-fit:cover;object-position:50% 50%;">
                    @endif
                </div>
                <div class="mt-4">
                    <input type="file" accept=".jpg,.jpeg,.png" name="foto" id="file-upload" style="display:none;"/>
                    <label for="file-upload" class="btn btn-outline-success rounded-pill btn-lg">Pilih Gambar</label>
                    <label id="nama-foto" class="mt-2"></label>
                </div>
            </center>
        </div>
        </form>
    </div>
</div>
@section('js')
<script>
    $(document).ready(function(){
        $('.toast').toast('show');
        $(function() {
          $("#tgl_lahir").datepicker();
        });

        // Muncul nama foto
        $('#file-upload').change(function() {
            var file = $('#file-upload')[0].files[0].name;
            $('#nama-foto').text(file);
        });
        // end muncul nama foto
        // image preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#foto').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file-upload").change(function(){
            readURL(this);
        });
        // END of image preview
        // form sweetalert submit
        $('form #btn-ok').click(function(e) {
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
                    Swal.fire("Informasi","Data batal diubah.","error");
                }
            });
        })
        // end form
    })
    
</script>
@stop
@stop

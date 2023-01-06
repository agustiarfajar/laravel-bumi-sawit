@extends('../header')
@section('header-content')
@section('title', 'Ubah Password')
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
<div class="container" style="margin-bottom:100px">
    <div class="row mt-4">
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
                        <li class="list-group-item text-muted" style="border:0"><a href="{{url('profil')}}" class="link-secondary text-decoration-none">Profil</a></li>
                        <li class="list-group-item text-muted" style="border:0"><a href="{{url('ubah-password')}}" class="link-secondary text-decoration-none fw-semibold">Ubah Password</a></li>
                    </ul>
                </li>
                <li class="list-group-item" style="border:0"><a href="{{url('pesanan')}}" class="link-dark fw-semibold text-decoration-none">Pesanan Saya</a></li>
            </ul>
        </div>
        <div class="col-md-9 mb-3 mt-3">
            <div class="profil-form p-3" style="background:#E4EBBF;">
                <h4>Ubah Password</h4>
                <p class="text-muted">
                    Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun
                    @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Oops!</strong> Terjadi kesalahan.<br><br>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                </p>
                <form action="{{url('update-password', $data->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if(session()->has('error'))
                    <p><?php echo showError(Session::get('error')); ?></p>
                    @elseif(session()->has('success'))
                    <p><?php echo showSuccess(Session::get('success')); ?></p>
                    @endif 
                    <div class="row mb-3">
                        <label for="passwordlama" class="col-sm-3 col-form-label">Password Lama</label>
                        <div class="col-sm-9">
                            <input type="password" name="password_lama" class="form-control" id="passwordlama" placeholder="Masukkan Password Lama">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="passwordbaru" class="col-sm-3 col-form-label">Password Baru</label>
                        <div class="col-sm-9">
                            <input type="password" name="password_baru" class="form-control" id="passwordbaru" placeholder="Masukkan Password Baru">
                            <span style="font-size:12px;margin-bottom:30px;color:red">*minimal 6 karakter, dengan huruf besar dan kecil dan <br>angka, atau simbol</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="konfirpasswordbaru" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
                        <div class="col-sm-9">
                            <input type="password" name="konfirmasi_password_baru" class="form-control" id="konfirpasswordbaru" placeholder="Masukkan Ulang Password Baru">
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

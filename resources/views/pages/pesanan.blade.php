@extends('../header')
@section('header-content')
@section('title', 'Pesanan Saya')
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
                        <li class="list-group-item text-muted" style="border:0"><a href="{{url('ubah-password')}}" class="link-secondary text-decoration-none">Ubah Password</a></li>
                    </ul>
                </li>
                <li class="list-group-item" style="border:0"><a href="{{url('pesanan')}}" class="link-dark fw-semibold text-decoration-none">Pesanan Saya</a></li>
            </ul>
        </div>
        <div class="col-md-9 mb-3 mt-3">
        <div class="card">
                <div class="card-body">
                    <h5>Daftar Transaksi Pembelian</h5>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Produk</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                            @forelse($pesanan as $row)
                            <div class="card mt-2 mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span><i class="bi bi-bag"></i> Belanja | {{ date('d M Y H:i', strtotime($row->tgl_pesan)) }}</span> 
                                        @if($row->status == 'Menunggu Konfirmasi')
                                        <span class="badge bg-warning p-1">{{ $row->status }}</span>
                                        @elseif($row->status == 'Selesai')
                                        <span class="badge bg-success p-1">{{ $row->status }}</span>
                                        @endif
                                    </div>
                                    @php 
                                        $pesanan_detail = DB::table('pesanan as a')
                                            ->join('pesanan_detail as b', 'a.id', '=', 'b.id_pesan')
                                            ->join('produk as c', 'b.id_produk', '=', 'c.id')
                                            ->join('users as d', 'a.id_user', '=', 'd.id')
                                            ->select('a.*','b.harga','b.qty','b.total','c.nama as nama_produk','c.foto')               
                                            ->where('a.id', $row->id)
                                            ->where('a.id_user', $id_user)
                                            ->get();
                                    @endphp
                                    @foreach($pesanan_detail as $detail)
                                        <div class="d-flex justify-content-left align-items-center mt-2">
                                            <img src="{{ asset('assets/uploads/produk/'.$detail->foto) }}" width="75" height="75" alt="">
                                            <span class="p-3 fw-bold">{{$detail->nama_produk}}<br>
                                                <small class="fw-normal text-muted">{{$detail->qty}} x Rp{{number_format($detail->harga,0,',','.')}}</small>
                                            </span>
                                            <span class="p-3 text-muted text-end" style="position:absolute;right:0;margin:auto">Total Belanja<br><span class="fw-bold">Rp{{number_format($detail->total,0,',','.')}}</span></span>
                                        </div>
                                    @endforeach
                                    
                                </div>
                            </div>  
                            @empty
                            <p>No Data Available</p>
                            @endforelse
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('js')
<script>
    $(document).ready(function(){
    @if(session()->has('success'))
        Swal.fire({
            icon: "success",
            title: "Informasi",
            text: "{{Session::get('success')}}",
        })
    @endif 
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

@extends('admin.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Produk Kategori</h1>
      </div><!-- /.col -->   
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Produk Kategori</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pesanan</h3>
                    </div>
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                            <thead>
                            <tr align="center">
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" aria-sort="ascending" width="50">No.</th>
                                <th class="sorting" tabindex="0" aria-controls="example1">Tanggal Pesan</th>
                                <th class="sorting" tabindex="0" aria-controls="example1">Nama Pembeli</th>
                                <th class="sorting" tabindex="0" aria-controls="example1">No. Telepon</th>
                                <th class="sorting" tabindex="0" aria-controls="example1">Alamat</th>
                                <th class="sorting" tabindex="0" aria-controls="example1">Subtotal</th>
                                <th class="sorting" tabindex="0" aria-controls="example1" width="200">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>  
                                @php $i=1; @endphp
                                @foreach($pesanan as $row)
                                <tr align="center">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ date('d M Y H:i', strtotime($row->tgl_pesan)) }}</td>
                                    <td>{{ $row->nama_user }}</td>
                                    <td>{{ $row->no_telp }}</td>
                                    <td>{{ $row->alamat }}</td>
                                    <td>Rp{{ number_format($row->subtotal,0,',','.') }}</td>
                                    <td>
                                        @if($row->status == 'Menunggu Konfirmasi')
                                        <form action="{{url('update-pesanan-admin', $row->id)}}" method="post">
                                            @csrf
                                            <button type="button" class="badge bg-warning" style="border:none" onclick="konfirmasiUbah()">{{$row->status}}</button>
                                        </form>
                                        @elseif($row->status == 'Selesai')
                                        <span class="badge bg-success">{{$row->status}}</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('js')
<script>
$(document).ready(function(){
// ALERT 
var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
    });
});

@if(session()->has('success'))
    Toast.fire({
    icon: 'success',
    title: '{{Session::get("success")}}'
    })
@elseif(session()->has('error'))
    Toast.fire({
    icon: 'error',
    title: '{{Session::get("error")}}'
    })
@endif
</script>
@stop
@stop
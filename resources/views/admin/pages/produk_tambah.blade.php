@extends('admin.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Tambah Produk</h1>
      </div><!-- /.col -->   
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin-produk.index')}}">Produk</a></li>
          <li class="breadcrumb-item active">Tambah</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    <!-- Main content -->
    <section class="content">    
          
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Produk</h3>
              </div>
              <!-- /.card-header -->
                <form action="{{route('admin-produk.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible mt-2">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                    @endif
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nama">Nama Produk</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Produk">
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select name="id_kategori" id="kategori" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategori as $row)
                                        <option value="{{$row->id}}">{{$row->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" min="1" class="form-control" name="stok" id="stok" placeholder="Masukkan Stok">
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" class="form-control" id="harga" placeholder="Rp." onkeypress="return hanyaAngka(event)">
                                    <input type="hidden" name="harga" id="harga_db">
                                </div>
                                <div class="form-group">
                                    <label for="diskon">Diskon</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="diskon" value="0" id="diskon" min="0" max="100" class="form-control col-1">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Jenis Produk</label>
                                    <select name="jenis" id="kategori" class="form-control">
                                        <option value="">Pilih Jenis Produk</option>
                                        <!-- <option value="top-sales">Top Sales</option> -->
                                        <option value="favorit">Favorit</option>
                                        <option value="unggulan">Unggulan</option>
                                    </select>
                                    <small class="text-danger">*boleh dikosongkan</small>
                                </div>
                                <div class="form-group">
                                    <label for="detail">Detail Produk</label>
                                    <textarea id="detail" name="detail">
                                        
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="spesifikasi">Spesifikasi Produk</label>
                                    <textarea id="spesifikasi" name="spesifikasi">
                                        
                                    </textarea>
                                </div>
                            </div>
                                <div class="col-md-4">
                                    <label for="" class="control-label">Foto Produk</label>
                                    <small class="text-danger">*Max: 2MB</small>     
                                    <div class="form-group">
                                    <input type="file" accept=".jpeg,.jpg,.png" name="foto" class="myfrm form-control">
                                        <!-- <div class="input-group-btn"> 
                                            <button class="btn btn-success" type="button"><i class="fas fa-plus"></i></button>
                                        </div> -->
                                    </div>
                                    <button type="button" onclick="konfirmasiSimpan()" class="btn btn-primary w-100">Simpan</button>
                                    <!-- <div class="clone d-none">
                                        <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                            <input type="file" name="foto[]" class="myfrm form-control">
                                            <div class="input-group-btn"> 
                                            <button class="btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
    
    // @if (count($errors) > 0)
    //     @foreach ($errors->all() as $error)
    //         Toast.fire({
    //             icon: 'error',
    //             title: '{{ $error }}'
    //         })
    //     @endforeach
    // @endif
    // END ALERT

    // MULTIPLE FILE UPLOAD
    // $(".btn-success").click(function(){ 
    //     var lsthmtl = $(".clone").html();
    //     $(".increment").after(lsthmtl);
    // });
    // $("body").on("click",".btn-danger",function(){ 
    //     $(this).parents(".hdtuto").remove();
    // });
    // END MULTIPLE
    // EDITOR
        $('#detail').summernote()
        $('#spesifikasi').summernote()
    // END EDITOR
  })
</script>
@stop
@stop
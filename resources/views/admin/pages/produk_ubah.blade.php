@extends('admin.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Ubah Produk</h1>
      </div><!-- /.col -->   
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin-produk.index')}}">Produk</a></li>
          <li class="breadcrumb-item active">Ubah</li>
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
                <h3 class="card-title">Form Ubah Produk</h3>
              </div>
              <!-- /.card-header -->
                <form action="{{route('admin-produk.update', $produk->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
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
                                    <input type="text" class="form-control" name="nama" id="nama" value="{{$produk->nama}}" placeholder="Masukkan Nama Produk">
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select name="id_kategori" id="kategori" class="form-control">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategori as $row)
                                        <option value="{{$row->id}}"{{($row->id == $produk->id_kategori ? 'selected' : '')}}>{{$row->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" min="1" class="form-control" name="stok" id="stok" value="{{$produk->stok}}" placeholder="Masukkan Stok">
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" class="form-control" id="harga" value="{{$produk->harga}}" placeholder="Masukkan Harga">
                                    <input type="hidden" name="harga" id="harga_db" value="{{$produk->harga}}">
                                </div>
                                <div class="form-group">
                                    <label for="diskon">Diskon</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="diskon" value="0" id="diskon" min="0" max="100" value="{{$produk->diskon}}" class="form-control col-1">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Jenis Produk</label>
                                    <select name="jenis" id="kategori" class="form-control">
                                        <option value="">Pilih Jenis Produk</option>
                                        <option value="top-sales" {{($produk->jenis == 'top-sales' ? 'selected' : '')}}>Top Sales</option>
                                        <option value="favorit" {{($produk->jenis == 'favorit' ? 'selected' : '')}}>Favorit</option>
                                        <option value="unggulan" {{($produk->jenis == 'unggulan' ? 'selected' : '')}}>Unggulan</option>
                                    </select>
                                    <small class="text-danger">*boleh dikosongkan</small>
                                </div>
                                <div class="form-group">
                                    <label for="detail">Detail Produk</label>
                                    <textarea id="detail" name="detail">
                                      {{$produk->detail}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="spesifikasi">Spesifikasi Produk</label>
                                    <textarea id="spesifikasi" name="spesifikasi">
                                    {{$produk->spesifikasi}}  
                                    </textarea>
                                </div>
                            </div>
                              <div class="col-md-4">
                                <label for="" class="control-label">Foto Produk</label>   
                                <small class="text-danger">*Max: 2MB</small>                               
                                <div class="input-group hdtuto control-group lst increment" >
                                <input type="file" accept=".jpeg,.jpg,.png" name="foto" class="myfrm form-control">
                                    <div class="input-group-btn"> 
                                        <button class="btn btn-success" type="button"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>          
                                <img src="{{asset('assets/uploads/produk/'.$produk->foto)}}" class="img-thumbnail img-fluid mt-2 mb-2" width="200">                         
                                <button type="button" onclick="konfirmasiUbah()" class="btn btn-primary mt-3 w-100">Update</button>
                                <div class="clone d-none">
                                  <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                                    <input type="file" name="fotobaru[]" class="myfrm form-control">
                                    <div class="input-group-btn"> 
                                      <button class="btn btn-danger" type="button"><i class="fas fa-trash"></i></button>
                                    </div>
                                  </div>                                  
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
    $(".btn-success").click(function(){ 
        var lsthmtl = $(".clone").html();
        $(".increment").after(lsthmtl);
    });
    $("body").on("click",".btn-danger",function(){ 
        $(this).parents(".hdtuto").remove();
    });
    // END MULTIPLE

    // EDITOR
        $('#detail').summernote()
        $('#spesifikasi').summernote()
    // END EDITOR
  })
</script>
@stop
@stop
@extends('admin.layout')
@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Produk</h1>
      </div><!-- /.col -->   
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="admin-dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Produk</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <a href="{{route('admin-produk.create')}}" class="btn btn-app">
        <i class="fas fa-plus"></i> Tambah
    </a>
      
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Produk</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">             
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                    <thead>
                    <tr align="center">
                      <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" aria-sort="ascending" width="20">No.</th>
                      <th class="sorting" tabindex="0" aria-controls="example1">Nama</th>
                      <th class="sorting" tabindex="0" aria-controls="example1">Kategori</th>
                      <th class="sorting" tabindex="0" aria-controls="example1">Stok</th>
                      <th class="sorting" tabindex="0" aria-controls="example1">Harga(Rp.)</th>
                      <th class="sorting" tabindex="0" aria-controls="example1">Detail</th>
                      <th class="sorting" tabindex="0" aria-controls="example1">Spesifikasi</th>
                      <th class="sorting" tabindex="0" aria-controls="example1">Diskon</th>
                      <th class="sorting" tabindex="0" aria-controls="example1">Jenis</th>
                      <th class="sorting" tabindex="0" aria-controls="example1">Foto</th>
                      <th class="sorting" tabindex="0" aria-controls="example1">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>  
                    <?php $i=1; ?>
                    @foreach($produk as $row)
                      <tr align="center">
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->kategori }}</td>
                        <td>{{ $row->stok }}</td>
                        <td>{{ number_format($row->harga,0,',','.') }}</td>
                        <td>{!! substr($row->detail, 0, 100) !!}...</td>
                        <td>{!! substr($row->spesifikasi, 0, 100) !!}...</td>
                        <td>{{ $row->diskon }}%</td>
                        <td>{{ ($row->jenis == "" ? 'baru' : $row->jenis) }}</td>
                        <td><a href="{{asset('assets/uploads/produk/'.$row->foto)}}" target="_blank"><img src="{{asset('assets/uploads/produk/'.$row->foto)}}" class="img-thumbnail img-fluid" width="80" height="80"></a></td>
                        <td>
                          <form action="{{route('admin-produk.destroy', $row->id)}}" method="post">
                            <a href="{{route('admin-produk.edit', $row->id)}}" class="btn btn-outline-primary mt-2"><i class="fas fa-pen"></i></a>
                            @csrf 
                            @method('delete')
                            <button type="button" class="btn btn-outline-danger mt-2" onclick="konfirmasiHapus()"><i class="fas fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>  
                </div>
              </div>
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
    // END ALERT

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
  })
</script>
@stop
@stop
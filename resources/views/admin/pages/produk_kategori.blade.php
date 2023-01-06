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

    <!-- Main content -->
    <section class="content">
    <button type="button" class="btn btn-app" data-toggle="modal" data-target="#modal-default">
        <i class="fas fa-plus"></i> Tambah
      </button>
      <form action="{{route('admin-produk-kategori.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Form Tambah Kategori Produk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p>
                  <div class="form-group">
                    <label for="nama" class="control-label">Nama Kategori</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Kategori">
                  </div>
                  <div class="form-group">
                    <label for="" class="control-label">Foto</label>
                    <img src="{{asset('assets/images/add-pict.png')}}" id="foto" class="img-fluid img-thumbnail" style="width:100%;height:300px;object-fit:cover;object-position:50% 50%">
                    <p id="nama-foto" class="text-center"></p>
                    <label for="file-upload" class="btn btn-outline-primary w-100">Upload Foto Kategori</label>
                    <input type="file" name="foto" accept=".jpeg,.jpg,.png" id="file-upload" class="form-control" style="display:none">                   
                  </div>
                </p>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="button" onclick="konfirmasiSimpan()" class="btn btn-primary">Simpan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      </form>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Kategori</h3>
              </div>
              <!-- /.card-header -->
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
                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" aria-describedby="example1_info">
                    <thead>
                    <tr align="center">
                      <th class="sorting sorting_asc" tabindex="0" aria-controls="example1" aria-sort="ascending" width="50">No.</th>
                      <th class="sorting" tabindex="0" aria-controls="example1">Nama Kategori</th>
                      <th class="sorting" tabindex="0" aria-controls="example1">Foto</th>
                      <th class="sorting" tabindex="0" aria-controls="example1" width="200">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>  
                      @foreach($kategori as $row)
                      <tr align="center">
                        <td>{{ $i++ }}</td>
                        <td>{{ $row->nama }}</td>
                        <td><a href="{{asset('assets/uploads/produk-kategori/'.$row->foto)}}" target="_blank"><img src="{{asset('assets/uploads/produk-kategori/'.$row->foto)}}" class="img-thumbnail img-fluid" width="80" height="80"></a></td>
                        <td>
                          <form action="{{route('admin-produk-kategori.destroy', $row->id)}}" method="post">
                            <a onclick="edit_kategori(this)" data-target="#edit_kategori" data-toggle="modal" data-id="{{$row->id}}" data-nama="{{$row->nama}}" data-foto="{{$row->foto}}" class="btn btn-outline-primary mt-2"><i class="fas fa-pen"></i></a>
                            @csrf 
                            @method('delete')
                            <button type="button" class="btn btn-outline-danger mt-2" onclick="konfirmasiHapus()"><i class="fas fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                  <!-- MODAL EDIT -->
                  <form action="#" id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal fade" id="edit_kategori" style="display: none;" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Form Ubah Kategori Produk</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="id_kategori" class="control-label">ID Kategori</label>
                              <input type="text" name="id_kategori" id="id_edit" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                              <label for="nama" class="control-label">Nama Kategori</label>
                              <input type="text" name="nama" id="nama_edit" class="form-control" placeholder="Masukkan Nama Kategori">
                            </div>
                            <div class="form-group">
                              <label for="" class="control-label">Foto</label>
                              <img src="{{asset('assets/images/add-pict.png')}}" id="foto-edit" class="img-fluid img-thumbnail" style="width:100%;height:300px;object-fit:cover;object-position:50% 50%">
                              <p id="nama-foto-edit" class="text-center"></p>
                              <label for="file-upload-edit" class="btn btn-outline-primary w-100">Upload Foto Kategori</label>
                              <input type="file" name="foto" accept=".jpeg,.jpg,.png" id="file-upload-edit" class="form-control" style="display:none">                   
                            </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <button type="button" onclick="konfirmasiUbah()" class="btn btn-primary">Ubah</button>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                  </form>
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

    @error('nama')
      Toast.fire({
        icon: 'error',
        title: '{{ $message }}'
      })
    @enderror
    @error('foto')
      Toast.fire({
        icon: 'error',
        title: '{{ $message }}'
      })
    @enderror
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

  // EDIT ON MODAL
  function edit_kategori(el) {
       var link = $(el) //refer `a` tag which is clicked
        var modal = $("#edit_kategori") //your modal
        var nama = link.data('nama')
        var id = link.data('id')
        var foto = link.data('foto')
        var url = '{{asset("assets/uploads/produk-kategori")}}';
        var url_update = "{{route('admin-produk-kategori.update', "+id+")}}";
        // add attr action form
        $('#editForm').attr('action', url_update);
        // end add attr

        modal.find('#nama_edit').val(nama);
        modal.find('#id_edit').val(id);
        modal.find('#nama-foto-edit').text(foto);
        modal.find('#foto-edit').attr('src', url+'/'+foto);
          // Muncul nama foto
          $('#file-upload-edit').change(function() {
              var file = $('#file-upload-edit')[0].files[0].name;
              $('#nama-foto-edit').text(file);
          });
          // end muncul nama foto
          // image preview
          function readURLEdit(input) {
              if (input.files && input.files[0]) {
                  var reader = new FileReader();

                  reader.onload = function (e) {
                      $('#foto-edit').attr('src', e.target.result);
                  }

                  reader.readAsDataURL(input.files[0]);
              }
          }

          $("#file-upload-edit").change(function(){
              readURLEdit(this);
          });
          // END of image preview   
      }
      // END EDIT 
</script>
@stop
@stop
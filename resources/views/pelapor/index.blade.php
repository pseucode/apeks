@extends('layouts.induk')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark card-title">Data Pelapor</h6>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button type="button" title="Import" class="btn btn-sm btn-info mb-3" data-toggle="modal" data-target="#ImportExcel"><i class="fa fa-plus"></i> Import</button>
              <button type="button" title="Tambah" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#ModalTambah"><i class="fa fa-plus"></i> Tambah</button>

              <!-- Modal tambah -->
              <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <!-- form -->
                      <form action="{{ route('pelapor.tambah') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="nama">nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="jns_kelamin">Jenis Kelamin</label>
                            <select id="jns_kelamin" name="jns_kelamin" class="form-control" required>
                              <option disabled selected value>----Pilih Gender----</option>
                              <option value="L">Laki-Laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="no_telp">No. HP</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end modal tambah -->

              <!-- Import Excel -->
              <div class="modal fade" id="ImportExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post" action="{{ route('pelapor.import') }}" enctype="multipart/form-data">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Data Pelapor</h5>
                      </div>
                      <div class="modal-body">
          
                        {{ csrf_field() }}
          
                        <label>Pilih file excel</label>
                        <div class="form-group">
                          <input type="file" name="file" required="required">
                        </div>
          
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nip</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Jenis Kelamin</th>
                  <th>No.Hp</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pelapors as $pelapor)
                <tr>
                  <td>{{ $pelapor->nip }}</td>
                  <td>{{ $pelapor->nama }}</td>
                  <td>{{ $pelapor->jabatan }}</td>
                  <td>{{ $pelapor->jns_kelamin }}</td>
                  <td>{{ $pelapor->no_telp }}</td>
                  <td>
                    <button type="button" title="Update" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ModalEdit{{$pelapor->id}}"><i class="fa fa-edit text-white"></i></button> 
                    <button type="button" title="Hapus" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDelete{{$pelapor->id}}"><i class="fa fa-trash text-white"></i></button>
                  </td>
                </tr>

              <!-- Modal Edit -->
              <div class="modal fade" id="ModalEdit{{$pelapor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Pelapor</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{route('pelapor.edit', $pelapor->id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="nip">Nip</label>
                            <input type="text" class="form-control" id="nip" name="nip" value="{{ $pelapor->nip }}" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $pelapor->nama }}" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $pelapor->jabatan }}" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="jns_kelamin">Jenis Kelamin</label>
                            <select id="jns_kelamin" name="jns_kelamin" class="form-control" value="{{ $pelapor->jns_kelamin }}" required>
                              <option disabled selected value>----Pilih Gender----</option>
                              <option value="L">Laki-Laki</option>
                              <option value="P">Perempuan</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="no_telp">No. HP</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $pelapor->no_telp }}" required>
                          </div>   
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End Modal Edit -->

                <!-- Modal delete-->
                <div class="modal fade" id="ModalDelete{{$pelapor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Anda yakin ingin menghapus?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <a href="{{ route('pelapor.hapus', $pelapor->id) }}" class="btn btn-primary">Iya</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal delete-->

                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
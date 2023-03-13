@extends('layouts.induk')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark card-title">Data User</h6>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button type="button" title="Tambah" class="btn btn-sm btn-info mb-3" data-toggle="modal" data-target="#ModalTambah"><i class="fa fa-plus"></i> Tambah</button>
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
                      <form action="/user/tambah" method="POST">
                        {{ csrf_field() }}
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                          </div>
                        </div>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="level">Level</label>
                            <select id="level" name="level" class="form-control" required>
                              <option disabled selected value>----Pilih Level----</option>
                              <option>teknisi</option>
                              <option>admin</option>
                            </select>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->level }}</td>
                  <td>
                    <button type="button" title="Reset" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ModalReset{{$user->id}}"><i class="fa fa-unlock"></i></button>
                    <button type="button" title="Hapus" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDelete{{$user->id}}"><i class="fa fa-trash"></i></button>  
                  </td>
                </tr>
                <!-- Modal reset-->
                <div class="modal fade" id="ModalReset{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Anda yakin ingin reset password?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                        <a href="{{ route('user.reset', $user->id)}}" class="btn btn-primary">Iya</a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal reset-->

                <!-- Modal delete-->
                <div class="modal fade" id="ModalDelete{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <a href="{{ route('user.hapus', $user->id)}}" class="btn btn-primary">Iya</a>
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
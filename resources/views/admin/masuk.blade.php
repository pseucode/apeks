@extends('layouts.induk')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark card-title">Pengaduan Masuk</h6>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Barang</th>
                  <th>Lokasi</th>
                  <th>Tgl. Aduan</th>
                  <th>Isi Aduan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($pengaduans as $pengaduan)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $pengaduan->nama }}</td>
                  <td>{{ $pengaduan->barang }}</td>
                  <td>{{ $pengaduan->lokasi }}</td>
                  <td>{{ \Carbon\Carbon::parse($pengaduan->tgl_aduan)->format('d-m-Y') }}</td>
                  <td>{{ $pengaduan->isi_aduan }}</td>
                  <td>{{ $pengaduan->status }}</td>
                  <td>@if($pengaduan->status == 'Baru')
                    <button type="button" title="Forward" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ModalForward{{$pengaduan->id}}"><i class="fa fa-share"></i></button>
                  @endif
                  @if($pengaduan->status == 'Sudah diTeruskan')
                  <button type="button" title="Detail" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#ModalDetail{{$pengaduan->id}}"><i class="fa fa-list text-white"></i></button>
                  @endif
                  <button type="button" title="Hapus" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDelete{{$pengaduan->id}}"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <!-- Modal Forward -->
                <div class="modal fade" id="ModalForward{{ $pengaduan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Forward Laporan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <!-- form -->
                        <form action="/pengaduan/forward/{{ $pengaduan->id }}" method="POST">
                          @csrf
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="catatan">Catatan</label>
                              <input type="text" class="form-control" id="catatan" name="catatan" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="teknisi">Teknisi</label>
                              <select id="teknisi" name="user_id" class="form-control" required>
                                @foreach ($users as $user)
                                @if($user->level != 'admin')
                                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
                                @endforeach
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
                <!-- end modal forward -->

                <!-- Modal Detail -->
                <div class="modal fade" id="ModalDetail{{ $pengaduan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Laporan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-4"> Nama </div>
                          <div class="col-8"> : {{$pengaduan->nama}}</div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-4"> No. Telp </div>
                          <div class="col-8"> : {{$pengaduan->no_telp}}</div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-4"> Jabatan </div>
                          <div class="col-8"> : {{$pengaduan->jabatan}}</div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-4"> Catatan </div>
                          <div class="col-8"> : {{$pengaduan->catatan}}</div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-4"> Nama Teknisi </div>
                          <div class="col-8"> : {{isset($pengaduan->user->name) ? $pengaduan->user->name : ''}}</div>
                        </div>
                        <hr>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal delete-->
                <div class="modal fade" id="ModalDelete{{$pengaduan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <a href="/pengaduan/hapus/{{$pengaduan->id}}" class="btn btn-primary">Iya</a>
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
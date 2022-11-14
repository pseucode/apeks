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
                  <th>Catatan</th>
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
                  <td>{{ $pengaduan->catatan }}</td>
                  <td><button type="button" title="Update" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ModalUpdate{{$pengaduan->id}}"><i class="fa fa-edit text-white"></i></button>
                  </td>
                </tr>
                
                <!-- Modal Update -->
                <div class="modal fade" id="ModalUpdate{{$pengaduan->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Laporan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="/pengaduan/masuk/update/{{$pengaduan->id}}" method="post" enctype="multipart/form-data">
                          {{csrf_field()}}
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="nama">Nama</label>
                              <input type="text" class="form-control" value="{{$pengaduan->nama}}" id="nama" name="nama" disabled>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="barang">Barang</label>
                              <input type="text" class="form-control" value="{{$pengaduan->barang}}" id="barang" name="barang" disabled>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="isi_aduan">Keluhan</label>
                              <textarea rows="3" class="form-control" id="isi_aduan" name="isi_aduan" disabled>{{$pengaduan->isi_aduan}}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="">Pengerjaan</label><br>
                              <input type="radio" name="pengerjaan" id="Teknisi" onclick="javascript:yesnoCheck();" value="Ditangani Teknisi"> Ditangani Teknisi <br>
                              <input type="radio" name="pengerjaan" id="PihakLuar" onclick="javascript:yesnoCheck();" value="Ditangani Pihak Luar"> Ditangani Pihak Luar <br>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="permasalahan">Permasalahan</label>
                              <textarea rows="3" class="form-control" id="permasalahan" name="permasalahan"></textarea>
                            </div> 
                            <div class="form-group col-md-6" style="display: none;" id="ifYes">
                              <label for="penyelesaian">Penyelesaian</label>
                              <textarea rows="3" class="form-control" id="penyelesaian" name="penyelesaian"></textarea>
                            </div>         
                          </div>
                          @section('showInput')
                          <script>
                             window.onload = function() {
                                document.getElementById('ifYes').style.display = 'none';
                            }
                            function yesnoCheck() {
                              if(document.getElementById('Teknisi').checked) {
                                document.getElementById('ifYes').style.display = 'block';
                              } 
                              if(document.getElementById('PihakLuar').checked) {
                                document.getElementById('ifYes').style.display = 'none';
                              } 
                            }
                          </script>
                          @endsection
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                        </form>
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
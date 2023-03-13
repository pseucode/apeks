@extends('layouts.induk')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark card-title">Pengaduan Progres</h6>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              {{-- menampilkan error validasi --}}
              @if (count($errors) > 0)
              <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> 
                    <strong>{{ $error }}</strong>
                  @endforeach
              </div>
              @endif
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Isi Aduan</th>
                  <th>Tgl. Aduan</th>
                  <th>Tgl. Followup</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($pengaduans as $pengaduan)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $pengaduan->pelapor->nama }}</td>
                  <td>{{ $pengaduan->isi_aduan }}</td>
                  <td>{{ \Carbon\Carbon::parse($pengaduan->tgl_aduan)->format('d-m-Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($pengaduan->tgl_followups)->format('d-m-Y') }}</td>
                  <td>{{ $pengaduan->status }}</td>
                  <td><button type="button" title="Konfirmasi" class="btn btn-sm btn-warning"  data-toggle="modal" data-target="#Konfirmasi{{ $pengaduan->id }}"><i class="fa fa-list-ul text-white"></i></button>
                  </td>
                </tr>

                  <!-- Modal konfrimasi -->
                <div class="modal fade" id="Konfirmasi{{ $pengaduan->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Laporan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('pengaduan.konfirmasi', $pengaduan->id) }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="nama">Nama</label>
                              <input type="text" class="form-control" value="{{$pengaduan->pelapor->nama}}" id="nama" name="nama" disabled>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="isi_aduan">Keluhan</label>
                              <input type="text" class="form-control" value="{{$pengaduan->isi_aduan}}" id="isi_aduan" name="isi_aduan" disabled>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="permasalahan">Permasalahan</label>
                              <textarea rows="3" class="form-control" id="permasalahan" name="permasalahan" disabled>{{ $pengaduan->permasalahan }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="penyelesaian">Penyelesaian</label>
                              <textarea rows="3" class="form-control" id="penyelesaian" name="penyelesaian" readonly required>{{ $pengaduan->penyelesaian }}</textarea>
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-6">
                              @if($pengaduan->signature != '')
                              <label for="signature">TTD Pelapor</label>
                              <img width="220px" src="{{ $pengaduan->ttd() }}" alt="">
                              @endif
                            </div>
                            <div class="form-group col-6">
                              <label for="pengerjaan">Pengerjaan</label>
                              <input type="text" class="form-control" value="{{$pengaduan->pengerjaan . '-' . $pengaduan->user->name}}" id="pengerjaan" name="pengerjaan" disabled>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Konfirmasi</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Modal Konfirmasi-->

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
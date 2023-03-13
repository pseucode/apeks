@extends('layouts.induk')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark card-title">Pengaduan Selesai</h6>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Isi Aduan</th>
                  <th>Tgl. Aduan</th>
                  <th>Tgl. Selesai</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($pengaduans as $pengaduan)
                    @if($pengaduan->status == 'Selesai')
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $pengaduan->pelapor->nama }}</td>
                  <td>{{ $pengaduan->isi_aduan }}</td>
                  <td>{{ \Carbon\Carbon::parse($pengaduan->tgl_aduan)->format('d-m-Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($pengaduan->tgl_followups)->format('d-m-Y') }}</td>
                  <td>{{ $pengaduan->status }}</td>
                  <td><a title="Detail" class="btn btn-sm btn-secondary" href="{{ route('selesai.detail', $pengaduan->id) }}"><i class="fa fa-list text-white"></i></a>
                  </td>
                </tr>
                    @endif
        
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
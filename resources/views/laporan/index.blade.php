@extends('layouts.induk')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card shadow mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-dark card-title">Laporan Kerusakan</h6>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <a href="{{ route('laporanPDF') }}" title="Cetak PDF" class="btn btn-sm btn-danger mb-3 text-white"><i class="fa fa-file-pdf text-white"></i> PDF</a>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Barang</th>
                  <th>Lokasi</th>
                  <th>Isi Aduan</th>
                  <th>Tgl. Aduan</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($followups as $followup)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $followup->pengaduan->nama }}</td>
                  <td>{{ $followup->pengaduan->barang }}</td>
                  <td>{{ $followup->pengaduan->lokasi }}</td>
                  <td>{{ $followup->pengaduan->isi_aduan }}</td>
                  <td>{{ \Carbon\Carbon::parse($followup->pengaduan->tgl_aduan)->format('d-m-Y') }}</td>
                  <td>{{ $followup->pengaduan->status }}</td>
                </tr>
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
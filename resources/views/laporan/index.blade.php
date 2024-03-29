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
              <form action="{{ route('laporanPDF') }}" method="post">
                @csrf
                <div class="form-row">
                  <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <label for="startDate">Dari Tanggal</label>
                    <input type="date" class="form-control" id="startDate" name="startDate" required>
                  </div>
                  <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <label for="endDate">Sampai Tanggal</label>
                    <input type="date" class="form-control" id="endDate" name="endDate" required>
                  </div>
                  <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <label for="pilihan">Pilih</label>
                    <select name="pilihan" id="pilihan" class="form-control">
                      <option disabled selected value>-----</option>
                      <option value="all">All</option>
                      @foreach ($teknisis as $teknisi)
                      <option value="{{ $teknisi->id }}">{{ $teknisi->name }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <button type="submit" title="Cetak PDF" class="btn btn-primary mb-3"><i class="fa fa-file-pdf text-white"></i> Cetak</button>
              </form>
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
                  @foreach($pengaduans as $pengaduan)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $pengaduan->pelapor->nama }}</td>
                  <td>{{ $pengaduan->barang }}</td>
                  <td>{{ $pengaduan->lokasi }}</td>
                  <td>{{ $pengaduan->isi_aduan }}</td>
                  <td>{{ \Carbon\Carbon::parse($pengaduan->tgl_aduan)->format('d-m-Y') }}</td>
                  <td>{{ $pengaduan->status }}</td>
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
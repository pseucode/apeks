@extends('layouts.induk')
@section('content')
<!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-9 col-md-12">
          <div class="card shadow mb-3 mt-4">
            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-dark text-center">Detail Laporan</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-4 col-md-4"> Nama </div>
                <div class="col-8 col-md-8"> : {{$followups->pengaduan->nama}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-4 col-md-4"> Jabatan </div>
                <div class="col-8 col-md-8"> : {{$followups->pengaduan->jabatan}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-4 col-md-4"> Barang IT </div>
                <div class="col-8 col-md-8"> : {{$followups->pengaduan->barang}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-4 col-md-4"> Lokasi </div>
                <div class="col-8 col-md-8"> : {{$followups->pengaduan->lokasi}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-4 col-md-4"> Tgl. Aduan </div>
                <div class="col-8 col-md-8"> : {{\Carbon\Carbon::parse($followups->pengaduan->tgl_aduan)->format('d-m-Y')}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-4 col-md-4"> Isi Aduan </div>
                <div class="col-8 col-md-8"> : {{$followups->pengaduan->isi_aduan}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-4 col-md-4"> Pengerjaan </div>
                <div class="col-8 col-md-8"> : {{$followups->pengerjaan}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-4 col-md-4"> Status </div>
                <div class="col-8 col-md-8"> : {{$followups->pengaduan->status}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-4 col-md-4"> Permasalahan </div>
                <div class="col-8 col-md-8"> : {{$followups->permasalahan}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-4 col-md-4"> Penyelesaian </div>
                <div class="col-8 col-md-8"> : {{$followups->penyelesaian}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-4 col-md-4"> Tgl. Followup </div>
                <div class="col-8 col-md-8"> : {{\Carbon\Carbon::parse($followups->tgl_followups)->format('d-m-Y')}}</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-4 col-md-4"> TTD. Pelapor </div>
                <div class="col-8 col-md-8"> : <img width="150px" style="object-fit: cover; object-position: 100% 0;" src="{{ $followups->pengaduan->ttd() }}" alt=""></div>
              </div>         
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
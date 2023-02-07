@extends('layouts.induk')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $masuk }}</h3>
            <p>Laporan Masuk</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-send"></i>
          </div>
          <a href="{{ route('pengaduan.masuk') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $progres }}</h3>
            <p>Laporan Progres</p>
          </div>
          <div class="icon">
            <i class="ion ion-load-a"></i>
          </div>
          <a href="{{ route('pengaduan.progres') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $selesai }}</h3>
            <p>Laporan Selesai</p>
          </div>
          <div class="icon">
            <i class="ion ion-android-done-all"></i>
          </div>
          <a href="{{ route('pengaduan.selesai') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @if(Auth::user()->level == 'admin')
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>{{ $totalUser }}</h3>

            <p>Total User</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-stalker"></i>
          </div>
          <a href="{{ route('user') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      @endif

      @if(Auth::user()->level == 'teknisi')
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            @foreach($rating as $rate)
            <h3>{{ $rate->rating }}</h3>
            @endforeach

            <p>Rating</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-star-outline"></i>
          </div>
        </div>
      </div>
      @endif

      <!-- ./col -->
    </div>
    <div class="row">
      @if(Auth::user()->level == 'admin')
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-light">
          <div class="inner">
            <h3>{{ $totalLaporanByYear }}</h3>

            <p>Total Laporan per Tahun</p>
          </div>
          <div class="icon">
            <i class="ion ion-document-text"></i>
          </div>
        </div>
      </div>
      @endif
        <!-- ./col -->
    </div>
  </div>
</section>
@endsection
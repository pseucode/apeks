@extends('layouts.induk')
@section('content')
<!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-9 col-md-12">
          <div class="card shadow mb-3 mt-4">
            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-dark text-center">Detail Kinerja</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 col-md-12"><h3 class="text-center">{{ $users->name }}</h3></div>
              </div>
              <div class="row mt-3">
                <div class="col-md-6">
                  <h6>Bobot Penilaian Kinerja</h6>
                  <p>Penanganan Laporan Tepat Waktu : 5 POIN <br>Penanganan Melebihi Batas Waktu : 2 POIN</p>
                  <h6>Hasil Kinerja</h6>
                  <p>Laporan yang di tangani : {{ $totalKasus }} Kasus <br>Rata-Rata Kinerja (1-10) : {{ $rataKinerja }} Bintang</p>
                </div>
                <div class="col-md-6">
                  <h6>Chart Penanganan Laporan </h6>
                  <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
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

@section('chart')
<script type="text/javascript" src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
<script type="text/javascript">
  	//-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Baik', 
          'Sedang',
          'Buruk'
      ],
      datasets: [
        {
          data: [{{ $kinerjaBaik }},{{ $kinerjaSedang }},{{ $kinerjaBuruk }}],
          backgroundColor : ['#00a65a', '#f39c12','#f56954'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'pie',
      data: donutData,
      options: donutOptions      
    })
</script>
@endsection
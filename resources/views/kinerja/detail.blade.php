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
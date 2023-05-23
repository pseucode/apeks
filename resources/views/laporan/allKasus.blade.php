<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ public_path('css/bootstrap.min.css') }}">

    <title>Laporan PDF</title>
  </head>
  <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="font-weight-bold text-dark text-center mb-3">Laporan Kerusakan</h2>
            </div>
        </div>
              <!-- /.card-header -->
                <table class="table">
                  <thead class="thead-dark">
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
                    <td>{{ $pengaduan->pelapor }}</td>
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
      <!-- /.container-fluid -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="{{ public_path('js/jquery.slim.min.js') }}"></script>
    <script src="{{ public_path('js/bootstrap.bundle.min.js') }}"></script>

  </body>
</html>
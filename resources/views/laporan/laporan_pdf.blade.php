<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

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
      <!-- /.container-fluid -->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  </body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Trispace:wght@600&display=swap" rel="stylesheet">

    <title>Apek | SMKN1SBY</title>
<!-- Lava Landing Page https://templatemo.com/tm-540-lava-landing-page -->
      <!-- SweetAlert -->
    <link href="{{ asset('sweetAlert/sweetalert.css') }}">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-lava.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->


    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.php" class="logo">
                            APEK
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#welcome" class="menu-item">Home</a></li>
                            <li class="scroll-to-section"><a href="#form-pengaduan" class="menu-item">Pengaduan</a></li>
                            <li class="scroll-to-section"><a href="#cek-laporan" class="menu-item">Cek Laporan</a>
                            </li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->


    <!-- ***** Welcome Area Start ***** -->
    <div class="welcome-area" id="welcome">

        <!-- ***** Header Text Start ***** -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="left-text col-lg-6 col-md-12 col-sm-12 col-xs-12"
                        data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                        <h1><em>A</em>plikasi <em>PE</em>ngaduan <em>K</em>erusakan</h1>
                        <p>APEK adalah platform pengaduan kerusakan barang yang ada di SMK Negeri 1 Surabaya.</p> 
                        <div class="click-area">
                            <a href="#form-pengaduan" class="main-button-slider">Buat Pengaduan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->

    <div class="left-image-decor"></div>

    <!-- ***** Features Big Item Start ***** -->
    <section class="section" id="form-pengaduan">
        <div class="container">
            <div class="row">
                <div class="banner-form col-lg-6 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s">
                    {{-- <img src="images/banner-form.png"> --}}
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"
                    data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Form Pengaduan</h5>
                            <form action="{{ route('pengaduan.tambah') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="nip">NIP </label>
                                <input type="text" name="nip" class="form-control" id="nip" placeholder="Masukkan NIP" required>
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No. Telp : </label>
                                <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="081xxxxxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="barang">Sarpras yg dilaporkan : </label>
                                <input type="text" name="barang" class="form-control" id="barang" placeholder="Masukkan Sarpras" required>
                            </div>
                            <div class="form-group">
                                <label for="lokasi">Lokasi : </label>
                                <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Masukkan lokasi" required>
                            </div>
                            <div class="form-group">
                                <label for="isi_aduan">Keluhan : </label>
                                <textarea class="form-control" name="isi_aduan" id="pelapor" rows="3" placeholder="Masukkan Keluhan yang dihadapi" required></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary pull-right">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <div class="right-image-decor"></div>

    <!-- ***** Testimonials Starts ***** -->
    <section class="section" id="cek-laporan">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="center-heading">
                        <h2>Cek <em>Laporanmu</em></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                  <div class="card shadow mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-dark card-title">List Laporan</h6>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Isi Laporan</th>
                          <th>Tgl. Laporan</th>
                          <th>Nama Teknisi</th>
                          <th>Tgl. Followup</th>
                          <th>Status</th>                
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($getLaporan as $laporan)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $laporan->nama }}</td>
                          <td>{{ $laporan->isi_aduan }}</td>
                          <td>{{ \Carbon\Carbon::parse($laporan->tgl_aduan)->format('d-m-Y') }}</td>
                          <td>{{ $laporan->name ?? 'Belum Tersedia' }}</td>
                          <td>@if(empty($laporan->tgl_followups))
                            {{ '-' }}
                            @else
                            {{ \Carbon\Carbon::parse($laporan->tgl_followups)->format('d-m-Y') }}
                            @endif
                          </td>
                          <td style="background-color: {{ App\Bgstatus::STATUS_COLOR[$laporan->status] ?? 'none' }};">
                            {{ App\Bgstatus::STATUS_SELECT[$laporan->status] ?? '' }}
                        </td>
                        </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Testimonials Ends ***** -->


    <!-- ***** Footer Start ***** -->
    <footer id="contact-us">
        <div class="container">
            <div class="footer-content">
                <div class="row">
                    <!-- ***** Contact Form Start ***** -->
                    <!-- ***** Contact Form End ***** -->
                    <div class="right-content col-lg-6 col-md-12 col-sm-12">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="sub-footer">
                        <p> Build with <i class="fa fa-heart" aria-hidden="true"></i> <a href="https://instagram.com/enggaryansyah">Fathur Enggaryansyah</a> | SMKN 1 Surabaya 2022 | Template by <a rel="nofollow" href="https://templatemo.com">Lava Landing Page</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-2.1.0.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('js/owl-carousel.js') }}"></script>
    <script src="{{ asset('js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/imgfix.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Global Init -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- SweetAlert -->
    <script src="{{ asset('sweetAlert/sweetalert2.all.js') }}"></script>
    @include('sweetalert::alert')

    <script type="text/javascript">
        $(document).ready(function() {
            $( "#nip" ).autocomplete({
                source: "{{ route('autocomplete') }}",
                minLength: 8,
                select: function(event, ui) {
                    $('#nip').val(ui.item.value);
                }
            });
        });

  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
    </script>
</body>
</html>

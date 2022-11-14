<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Apek|SMKN1SBY</title>
<!-- Lava Landing Page https://templatemo.com/tm-540-lava-landing-page -->
      <!-- SweetAlert -->
    <link href="{{ asset('sweetAlert/sweetalert.css') }}">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-lava.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}">

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
                            <li class="scroll-to-section"><a href="#unsur-pengaduan" class="menu-item">Unsur Pengaduan</a>
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
                        <h1 class="desc"><em>A</em>plikasi <em>PE</em>ngaduan <em>K</em>erusakan</h1>
                        <p>APEK adalah platform pengaduan kerusakan peralatan IT yang ada di SMK Negeri 1 Surabaya.</p> 
                        <a href="#form-pengaduan" class="main-button-slider">Buat Pengaduan</a>
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
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Pelapor : </label>
                                <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Jabatan : </label>
                                <input type="text" name="jabatan" class="form-control" id="jabatan" placeholder="Siswa/Guru" required>
                            </div>
                            <div class="form-group">
                                <label for="no_telp">No. Telp : </label>
                                <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="081xxxxxxxxx" required>
                            </div>
                            <div class="form-group">
                                <label for="barang">Barang IT : </label>
                                <input type="text" name="barang" class="form-control" id="barang" placeholder="Komputer, Printer, Mouse" required>
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
    <div class="unsur-pengaduan-area" data-scroll-reveal="enter right move 30px over 0.6s after 0.4s"></div>

    <!-- ***** Testimonials Starts ***** -->
    <section class="section" id="unsur-pengaduan">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="center-heading">
                        <h2>Unsur <em>Pengaduan</em></h2>
                        <p>Pengaduan Anda akan mudah ditindak lanjuti apabila memenuhi unsur sebagai berikut : </p>
                    </div>
                </div>
            </div>
            <div class="row" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                <div class="col-lg-4">
                    <h3><em>What</em></h3>
                    <p>Berupa informasi mengenai suatu hal yang tidak berfungsi semestinya. <br> (misal : komputer)</p> <br>
                </div>
                <div class="col-lg-4 enter">
                    <h3><em>Who</em></h3>
                    <p>Siapa nama pelapor yang membuat pengaduan. <br> (misal : Fathur Enggaryansyah)</p>
                </div>
            </div>
            <div class="row" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                <div class="col-lg-4">
                    <h3><em>Where</em></h3>
                    <p>Lokasi terjadinya Kerusakan tersebut. <br> (misal : Ruang D. 101)</p> <br>
                </div>
                <div class="col-lg-4 enter">
                    <h3><em>When</em></h3>
                    <p>Waktu terjadinya kerusakan tersebut. <br> (misal : pada tanggal 00 bulan XX tahun 0000)</p>
                </div>
            </div>
            <div class="row" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                <div class="col-lg-4">
                    <h3><em>How</em></h3>
                    <p>Berisi informasi terkait detail permasalahan yang ditemukan (misal : komputer mati ketika di klik power on)</p>
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
                        <p>Copyright &copy; 2020 SMKN 1 Surabaya

                        | Template by <a rel="nofollow" href="https://templatemo.com">Lava Landing Page</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery-2.1.0.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Plugins -->
    <script src="{{ asset('js/owl-carousel.js') }}"></script>
    <script src="{{ asset('js/scrollreveal.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/imgfix.min.js') }}"></script>

    <!-- Global Init -->
    <script src="{{ asset('js/custom.js') }}"></script>
    <!-- SweetAlert -->
    <script src="{{ asset('sweetAlert/sweetalert2.all.js') }}"></script>
    @include('sweetalert::alert')
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Chemistry Program Data Center</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="/Assets/images/logo/color.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/Assets/src/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/Assets/src/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/Assets/src/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="/Assets/FontAwesome/css/fontawesome.css" rel="stylesheet">
    <link href="/Assets/FontAwesome/css/brands.css" rel="stylesheet">
    <link href="/Assets/FontAwesome/css/solid.css" rel="stylesheet">
    <!-- FontAwesome -->

    <!-- Jam -->
    <link href="/Assets/jamnya/css/style.css" rel="stylesheet">
    <!-- Jam -->

    <!-- Date -->
    <link href="/Assets/date/css/style.css" rel="stylesheet">
    <!-- Date -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/Assets/src/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/Assets/src/css/style.css" rel="stylesheet">
</head>

<body class="no-copy">
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <div class="container-fluid bg-primary text-white d-none d-lg-flex">
        <div class="container py-3">
            <div class="d-flex align-items-center">
                <a href="">
                    <img src="/Assets/images/logo/white.png" width="55" style="margin-top:-22px;" alt="Logo CPDC">
                </a>
                <div class="ms-auto d-flex align-items-center">
                    <small class="ms-4"><i class="fa fa-envelope me-3"></i>chemistry@fmipa.unila.ac.id</small>
                    <small class="ms-4"><i class="fa fa-phone-alt me-3"></i>0721-704625</small>
                    <small class="ms-4">
                        <i class="fa-solid fa-calendar-days me-3"></i>
                        <small id="tanggal" style="scale: 1;"></small>
                    </small>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-white sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light p-lg-0">
                <a href="{{ route('dashboard') }}" class="navbar-brand d-lg-none">
                    <img src="/Assets/images/logo/color.svg" width="45" style="margin-top: -25px;" alt="" />
                </a>
                <button type="button" class="navbar-toggler me-0" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse" style="margin-top:-20px;">
                    <div class="navbar-nav">
                        <a href="/" class="nav-item nav-link {{ Request::is('/') ? 'active' : '' }}">Beranda</a>
                        <a href="/about"
                            class="nav-item nav-link {{ Request::is('about') ? 'active' : '' }}">Tentang</a>
                        <div
                            class="nav-item dropdown {{ Request::is('kp*') || Request::is('kompre*') || Request::is('ta1*') || Request::is('ta2*') ? 'show' : '' }}">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Seminar</a>
                            <div class="dropdown-menu bg-light rounded-0 rounded-bottom m-0">
                                <a href="/kp"
                                    class="dropdown-item margin-top {{ Request::is('kp*') ? 'active' : '' }}">Kerja
                                    Praktik</a>
                                <a href="/ta1"
                                    class="dropdown-item margin-top {{ Request::is('ta1*') ? 'active' : '' }}">Tugas
                                    Akhir 1</a>
                                <a href="/ta2"
                                    class="dropdown-item margin-top {{ Request::is('ta2*') ? 'active' : '' }}">Tugas
                                    Akhir 2</a>
                                <a href="/kompre"
                                    class="dropdown-item margin-top {{ Request::is('kompre*') ? 'active' : '' }}">Komprehensif</a>
                            </div>
                            <style>
                                .margin-top {
                                    margin-top: 0px;
                                }
                            </style>
                        </div>
                        <a href="/help"
                            class="nav-item nav-link {{ Request::is('help') ? 'active' : '' }}">Bantuan</a>
                        @auth

                            {{-- tampil saat mode mobile --}}
                            <div class="login">
                                <a href="{{ route('dashboard') }}" class="nav-item nav-link">Dashboard</a>
                                <a href="{{ route('auth.logout') }}" class="nav-item nav-link text-danger">Keluar</a>
                            </div>
                        @else
                            <div class="login">
                                <a href="{{ route('auth.login') }}" class="nav-item nav-link text-primary">Masuk</a>
                            </div>
                            {{-- tampil saat mode mobile --}}
                        @endauth
                    </div>
                </div>
                @auth
                    <div class="new navbar-nav">
                        <div class="nav-item dropdown" style="margin-top:-20px;">
                            <a href="#" class="nav-link dropdown-toggle text-black text-bold"
                                data-bs-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu account bg-light rounded-0 rounded-bottom m-0">
                                <a href="{{ route('dashboard') }}" class="dropdown-item margin-top">Dashboard</a>
                                <a href="{{ route('auth.logout') }}" class="dropdown-item margin-top">Keluar</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="ms-auto d-none d-lg-block" style="margin-top:-20px;">
                        <a href="{{ route('auth.login') }}" class="btn btn-primary rounded-pill py-2 px-3">Masuk</a>
                    </div>
                @endauth
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid px-0 mb-5">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="Assets/src/img/carousel-4.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7 text-start">
                                    <p class="fs-4 text-white animated slideInRight">Welcome to
                                        <strong>Chemistry Program Data Center</strong>
                                    </p>
                                    <h1 class="display-1 text-white mb-4 animated slideInRight">Chemistry is the bridge
                                        between physics and biology</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="Assets/src/img/carousel-3.jpg" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-end">
                                <div class="col-lg-7 text-end">
                                    <p class="fs-4 text-white animated slideInLeft">Welcome to
                                        <strong>Chemistry Program Data Center </strong>
                                    </p>
                                    <h1 class="display-1 text-white mb-5 animated slideInLeft">Chemistry is science
                                        that
                                        changed the world</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->



    @yield('umum')


    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-5 col-md-6">
                    <h4 class="text-white mb-4">Kantor Kami</h4>
                    <p class="mb-2">
                        <i class="fa fa-map-marker-alt me-3"></i>
                        <a href="https://goo.gl/maps/A83Jjtq5YuN3Yerj9" target="_blank" class="alamat">
                            Jl. Prof. Dr. Ir.
                            Soemantri Brodjonegoro, Gedong Meneng, Rajabasa, Bandar Lampung
                        </a>
                    </p>
                    <style>
                        .alamat {
                            color: #b0b9ae;
                        }
                    </style>
                    <p class="mb-2">
                        <i class="fa fa-phone-alt me-3"></i>
                        <a href="tel:+62721704625" class="alamat" target="_blank">
                            0721-704625
                        </a>
                    </p>
                    <p class="mb-2">
                        <i class="fa fa-envelope me-3"></i>
                        <a target="_blank" href="mailto:chemistryprogramdatacenter@gmail.com" class="alamat">
                            Chemistryprogramdatacenter@gmail.com
                        </a>
                    </p>

                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-light rounded-circle me-2" target="_blank"
                            href="https://www.facebook.com/jurkimiafmipaunila/">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="btn btn-square btn-light rounded-circle me-2" target="_blank"
                            href="https://www.youtube.com/channel/UCyVqvR1r0J7V6Mq_5soQp8w">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a class="btn btn-square btn-light rounded-circle me-2" target="_blank"
                            href="https://www.linkedin.com/in/kimia-fmipa-universitas-lampung-a-3431a2181/?originalSubdomain=id">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    {{-- <div class="tanggal"></div> --}}
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="col-lg-5 col-md-6 px-lg-5">
                        <div id="clock">
                            <div class="jam">
                                <span id="horas">00</span>
                                <span class="time">Jam</span>
                            </div>
                            <div class="menit">
                                <span id="minutos">00</span>
                                <span class="time">Menit</span>
                            </div>
                            <div class="detik">
                                <span id="segundos">00</span>
                                <span class="time">Detik</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy;
                    <a class="fw-medium text-light" target="_blank" href="https://kimia.fmipa.unila.ac.id/">
                        Jurusan
                        KIMIA FMIPA UNILA</a>
                    <script>
                        document.write(new Date().getFullYear())
                    </script>

                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    Dirancang Oleh <a class="fw-medium text-light" href="/team">Bayanaka Team</a>
                    {{-- Distributed By <a class="fw-medium text-light" href="https://themewagon.com">ThemeWagon</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Assets/src/lib/wow/wow.min.js"></script>
    <script src="/Assets/src/lib/easing/easing.min.js"></script>
    <script src="/Assets/src/lib/waypoints/waypoints.min.js"></script>
    <script src="/Assets/src/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/Assets/src/lib/lightbox/js/lightbox.min.js"></script>


    <!-- Template Javascript -->
    <script src="/Assets/src/js/main.js"></script>
    <script src="/Assets/src/js/nocopy.js"></script>

    <!-- jam -->
    <script src="/Assets/jamnya/js/script.js"></script>
    <!-- date -->
    <script src="/Assets/date/js/date.js"></script>
    <script src="/Assets/date/js/tanggal.js"></script>


</body>

</html>

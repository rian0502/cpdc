@extends('layouts.umum')
@section('umum')
    <style>
        .text-justify {
            text-align: justify;
            text-justify: inter-word;
        }

        @media print {
            img {
                /* Hide the whole page */
                display: none;
            }
        }
    </style>
    <!-- Features Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 feature-row">
                <div class="col-md-12 col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="feature-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            {{-- <img class="img-fluid" src="Assets/src/img/icon/icon-1.png" alt="Icon"> --}}
                            <i class="img-fluid fa-3x fa-solid fa-database"></i>
                        </div>
                        <h5 class="mb-3">Pengolahan Data</h5>
                        <p class="mb-0">Efektifitas dan Optimasi Pengolahan Data</p>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                    <div class="feature-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            {{-- <img class="img-fluid" src="Assets/src/img/icon/icon-2.png" alt="Icon"> --}}
                            <i class="fa-3x fa-solid fa-lightbulb"></i>
                        </div>
                        <h5 class="mb-3">Pengambilan Keputusan</h5>
                        <p class="mb-0">Memudahkan Dalam Pengambilan Keputusan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- About Start -->
    <div class="container-xxl about my-5">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-6">
                    <div class="h-100 d-flex align-items-center justify-content-center" style="min-height: 300px;">
                        <button type="button" class="btn-play" data-bs-toggle="modal"
                            data-src="https://www.youtube.com/embed/G4_9cV4_EXw" data-bs-target="#videoModal">
                            <span></span>
                        </button>
                    </div>
                </div>
                <div class="col-lg-6 pt-lg-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white rounded-top p-5 mt-lg-5">
                        <p class="fs-5 fw-medium text-primary">Tentang Kami</p>
                        <h1 class="display-6 mb-4">Pusat Data Jurusan Kimia</h1>
                        <p class="mb-4" style="text-align: justify;letter-spacing: 0.5px;"> Sistem ini dirancang dengan
                            tujuan utama untuk
                            meningkatkan efektivitas dan optimasi pengolahan data di Jurusan Kimia. Dengan adanya sistem
                            ini, diharapkan tenaga pengajar dapat dengan mudah mengakses dan menganalisis data yang
                            diperlukan untuk
                            pengambilan keputusan yang lebih tepat. Selain itu, sistem ini juga bertujuan untuk mewujudkan
                            transformasi data yang lebih terstruktur dan terorganisir, sehingga memudahkan pengguna dalam
                            mencari dan menggunakan informasi yang relevan. Dengan penggunaan sistem ini, diharapkan proses
                            pengolahan data di Jurusan Kimia menjadi lebih efisien dan efektif, sehingga waktu dan sumber
                            daya dapat dioptimalkan dengan baik. Selain itu, sistem ini juga diharapkan dapat membantu
                            meningkatkan kualitas pengambilan keputusan tenaga pengajar dengan memberikan informasi yang
                            lebih akurat.
                        </p>

                        <a class="btn btn-primary rounded-pill py-3 px-5" href="https://kimia.fmipa.unila.ac.id/"
                            target="_blank">Jelajahi Lebih Lanjut</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Video Modal Start -->
    <div class="modal modal-video fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Youtube Video</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                            allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Modal End -->



    <!-- Project Start -->
    <div class="container-xxl pt-5" onmousedown='return false' oncontexmenu='return false' onselectstart='return false'>
        <div class="container">
            <div class="text-center text-md-start pb-5 pb-md-0 wow fadeInUp" data-wow-delay="0.1s"
                style="max-width: 500px;">
                <p class="fs-5 fw-medium text-primary">Laboratorium</p>
                <h1 class="display-5 mb-5">Jurusan Kimia</h1>
            </div>
            <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="project-item mb-5">
                    <div class="position-relative">
                        <img class="img-fluid" src="Assets/src/img/biokimia.png" alt="">
                        <div class="project-overlay">
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href="Assets/src/img/biokimia.png"
                                data-lightbox="project" oncontextmenu="return false;"><i class="fa fa-eye"></i></a>
                            @role('mahasiswa')
                                <a class="btn btn-lg-square btn-light rounded-circle m-1" href="/mahasiswa/lab/cekin"><i
                                        class="fa fa-link"></i></a>
                            @endrole
                        </div>
                    </div>
                    <div class="p-4">
                        <a class="d-block h5 mb-3" href="">Laboratorium Biokimia</a>
                        <p style="text-align: justify; text-justify: inter-word;">Tempat di mana penelitian dan eksperimen
                            yang terstruktur dilakukan secara intensif oleh para ilmuwan dan peneliti untuk mempelajari,
                            menguji, dan menganalisis reaksi kimia yang kompleks yang terjadi dalam sistem biologi yang
                            dinamis.</p>
                    </div>
                </div>
                <div class="project-item mb-5">
                    <div class="position-relative">
                        <img class="img-fluid" src="Assets/src/img/analitik dan instrumental.png" alt=""
                            oncontextmenu="return false;">
                        <div class="project-overlay">
                            <a class="btn btn-lg-square btn-light rounded-circle m-1"
                                href="Assets/src/img/analitik dan instrumental.png" data-lightbox="project"><i
                                    class="fa fa-eye"></i></a>
                            @role('mahasiswa')
                                <a class="btn btn-lg-square btn-light rounded-circle m-1" href="/mahasiswa/lab/cekin"><i
                                        class="fa fa-link"></i></a>
                            @endrole
                        </div>
                    </div>
                    <div class="p-4">
                        <a class="d-block h5 mb-3" href="">Laboratorium Kimia Analitik dan Instrumental</a>
                        <p style="text-align: justify; text-justify: inter-word;">Tempat di mana analisis dan pengujian
                            dilakukan menggunakan berbagai instrumen dan metode kimia untuk mengidentifikasi dan mengukur
                            komponen serta konsentrasi zat dalam sampel.</p>
                    </div>
                </div>
                <div class="project-item mb-5">
                    <div class="position-relative">
                        <img class="img-fluid" src="Assets/src/img/kimia anorganik-fisik.png" alt=""
                            oncontextmenu="return false;">
                        <div class="project-overlay">
                            <a class="btn btn-lg-square btn-light rounded-circle m-1"
                                href="Assets/src/img/kimia anorganik-fisik.png" data-lightbox="project"><i
                                    class="fa fa-eye"></i></a>
                            @role('mahasiswa')
                                <a class="btn btn-lg-square btn-light rounded-circle m-1" href="/mahasiswa/lab/cekin"><i
                                        class="fa fa-link"></i></a>
                            @endrole
                        </div>
                    </div>
                    <div class="p-4">
                        <a class="d-block h5 mb-3" href="">Laboratorium Kimia Anorganik atau Fisik</a>
                        <p style="text-align: justify; text-justify: inter-word;">Tempat di mana penelitian dan eksperimen
                            dilakukan untuk mempelajari sifat dan reaksi kimia dari senyawa anorganik atau materi dalam
                            bentuk fisik seperti kristal, struktur, konduktivitas, dan fenomena fisik lainnya.</p>
                    </div>
                </div>
                <div class="project-item mb-5">
                    <div class="position-relative">
                        <img class="img-fluid" src="Assets/src/img/kimia organik.png" alt=""
                            oncontextmenu="return false;">
                        <div class="project-overlay">
                            <a class="btn btn-lg-square btn-light rounded-circle m-1"
                                href="Assets/src/img/kimia organik.png" data-lightbox="project"><i
                                    class="fa fa-eye"></i></a>
                            @role('mahasiswa')
                                <a class="btn btn-lg-square btn-light rounded-circle m-1" href="/mahasiswa/lab/cekin"><i
                                        class="fa fa-link"></i></a>
                            @endrole
                        </div>
                    </div>
                    <div class="p-4">
                        <a class="d-block h5 mb-3" href="">Laboratorium Kimia Organik</a>
                        <p style="text-align: justify; text-justify: inter-word;">
                            Tempat penelitian dan eksperimen tentang struktur, sifat, sintesis, dan reaksi senyawa organik.
                            Metode dan teknik kimia digunakan untuk memahami dan mengembangkan molekul organik serta
                            aplikasinya dalam bidang farmasi, material, dan industri kimia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Project End -->
@endsection

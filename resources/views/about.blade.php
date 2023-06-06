@extends('layouts.umum')
@section('umum')
    <link rel="stylesheet" href="Assets/src/css/about.css">

    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center text-md-start pb-5 pb-md-0 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium text-primary">Peta</p>
                <h1 class="display-5 mb-5">Jurusan Kimia</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-12 wow fadeIn" data-wow-delay="0.01s" style="min-height: 450px;">
                    <div class="position-relative rounded overflow-hidden h-100">
                        <iframe class="position-relative w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248.270347928089!2d105.2439922581759!3d-5.36721460659867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40db01a4f4e7d7%3A0x1bb580f53dada343!2sDepartment%20of%20Chemistry!5e0!3m2!1sid!2sid!4v1685453109019!5m2!1sid!2sid"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" frameborder="0" style="min-height: 450px; border:0;"
                            allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Project Start -->

    <div class="container-xxl pt-5">
        <div class="container">
            <div class="text-center text-md-start pb-5 pb-md-0 wow fadeInUp" data-wow-delay="0.1s"
                style="max-width: 500px;">
                <p class="fs-5 fw-medium text-primary">Logo</p>
                <h1 class="display-5 mb-5">Pusat Data Jurusan Kimia</h1>
                <div class="bottomm"></div>
            </div>
            {{-- <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="project-item mb-5">
                    <div class="position-relative">
                        <img class="img-fluid" src="Assets/src/img/project-1.jpg" alt="">
                        <div class="project-overlay">
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href="img/project-1.jpg"
                                data-lightbox="project"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href=""><i
                                    class="fa fa-link"></i></a>
                        </div>
                    </div>
                    <div class="p-4">
                        <a class="d-block h5" href="">Data Analytics & Insights</a>
                        <span>Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem</span>
                    </div>
                </div>
                <div class="project-item mb-5">
                    <div class="position-relative">
                        <img class="img-fluid" src="Assets/src/img/project-2.jpg" alt="">
                        <div class="project-overlay">
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href="img/project-2.jpg"
                                data-lightbox="project"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href=""><i
                                    class="fa fa-link"></i></a>
                        </div>
                    </div>
                    <div class="p-4">
                        <a class="d-block h5" href="">Marketing Content Strategy</a>
                        <span>Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem</span>
                    </div>
                </div>
                <div class="project-item mb-5">
                    <div class="position-relative">
                        <img class="img-fluid" src="Assets/src/img/project-3.jpg" alt="">
                        <div class="project-overlay">
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href="img/project-3.jpg"
                                data-lightbox="project"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href=""><i
                                    class="fa fa-link"></i></a>
                        </div>
                    </div>
                    <div class="p-4">
                        <a class="d-block h5" href="">Business Target Market</a>
                        <span>Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem</span>
                    </div>
                </div>
                <div class="project-item mb-5">
                    <div class="position-relative">
                        <img class="img-fluid" src="Assets/src/img/project-4.jpg" alt="">
                        <div class="project-overlay">
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href="img/project-4.jpg"
                                data-lightbox="project"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href=""><i
                                    class="fa fa-link"></i></a>
                        </div>
                    </div>
                    <div class="p-4">
                        <a class="d-block h5" href="">Social Marketing Strategy</a>
                        <span>Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem</span>
                    </div>
                </div>
            </div> --}}

            <div class="body wow fadeInUp filosofinya" data-wow-delay="0.01s">
                <img id="logo" class="gambar" src="/Assets/images/logo/color.png" alt="Logo">
                

                <div id="filosofi">
                    <div class="filosofi-card kampus">
                        <h3 class="mb-4 mt-3 ">
                            <b>
                                Logo Universitas Lampung
                            </b>
                        </h3>
                        <p class="justify mt-5">Sistem ini berada di bawah naungan Universitas Lampung.</p>
                    </div>
                    <div class="filosofi-card bentuk">
                        <h3 class="mb-4 mt-3 ">
                            <b>
                                Bentuk lingkaran
                            </b>
                        </h3>
                        <p class="justify mt-5 color">Sistem ini dapat memastikan informasi terkini dan efisiensi tinggi.
                            Terlebih
                            dalam mengolah data mahasiswa di Jurusan kimia.</p>
                    </div>
                    <div class="filosofi-card abjad">
                        <h3 class="mb-4 mt-3">
                            <b>
                                Tulisan C P D C
                            </b>
                        </h3>
                        <p class="justify mt-5 color">Singkatan dari nama sistem yaitu Chemistry Program Data Center.</p>
                    </div>
                    <div class="filosofi-card warnanya">
                        <h3 class="mb-4 mt-3 color">
                            <b>
                                Warna Biru
                            </b>
                        </h3>
                        <p class="justify mt-5">Sistem ini dapat diandalkan untuk pengolahan data mahasiswa di Jurusan Kimia
                            dan membantu meningkatkan kinerja Jurusan.</p>
                    </div>
                </div>
            </div>
            {{-- <script>
                var filosofiCards = document.getElementsByClassName("filosofi-card");
                var logoImg = document.getElementById("logo");

                for (var i = 0; i < filosofiCards.length; i++) {
                    filosofiCards[i].addEventListener("mouseover", function() {
                        var imgClass = this.classList[1];
                        logoImg.src = "/Assets/images/logo/" + imgClass + ".png";
                        logoImg.classList.add("hovered");
                    });

                    filosofiCards[i].addEventListener("mouseout", function() {
                        logoImg.src = "/Assets/images/logo/color.png";
                        logoImg.classList.remove("hovered");
                    });
                }
            </script> --}}
            <div class="bottom"></div>
            
        </div>
    </div>
    <!-- Project End -->
    
    <!-- Testimonial Start -->
    <div class="bawah-testimonial"></div>
    {{-- <div class="container-xxl pt-5">
        <div class="container">
            <div class="text-center text-md-start pb-5 pb-md-0 wow fadeInUp" data-wow-delay="0.1s"
                style="max-width: 500px;">
                <p class="fs-5 fw-medium text-primary">Tenaga Pengajar</p>
                <h1 class="display-5 mb-5">Jurusan Kimia</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item rounded p-4 p-lg-5 mb-5">
                    <img class="mb-4" src="Assets/dosen/mulyono1.jpg" alt="">
                    <p class="mb-4">Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem
                        et
                        sit, sed stet lorem sit clita duo justo</p>
                    <h5>Mulyono, S.Si., M.Si., Ph.D.</h5>
                    <span class="text-primary">Ketua Jurusan</span>
                </div>
                <div class="testimonial-item rounded p-4 p-lg-5 mb-5">
                    <img class="mb-4" src="Assets/src/img/testimonial-2.jpg" alt="">
                    <p class="mb-4">Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem
                        et
                        sit, sed stet lorem sit clita duo justo</p>
                    <h5>Client Name</h5>
                    <span class="text-primary">Profession</span>
                </div>
                <div class="testimonial-item rounded p-4 p-lg-5 mb-5">
                    <img class="mb-4" src="Assets/src/img/testimonial-3.jpg" alt="">
                    <p class="mb-4">Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem
                        et
                        sit, sed stet lorem sit clita duo justo</p>
                    <h5>Client Name</h5>
                    <span class="text-primary">Profession</span>
                </div>
                <div class="testimonial-item rounded p-4 p-lg-5 mb-5">
                    <img class="mb-4" src="Assets/src/img/testimonial-4.jpg" alt="">
                    <p class="mb-4">Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem
                        et
                        sit, sed stet lorem sit clita duo justo</p>
                    <h5>Client Name</h5>
                    <span class="text-primary">Profession</span>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Testimonial End -->

    <script src="/Assets/src/js/tentang.js"></script>
@endsection

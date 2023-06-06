@extends('layouts.umum')
@section('umum')

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium text-primary">Tim Pengembang</p>
                <h1 class="display-5 mb-5">Mahasiswa Jurusan Ilmu Komputer</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-8 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item rounded overflow-hidden pb-4">
                        <img class="img-fluid mb-4" src="Assets/images/team/rian.jpg" alt="">
                        <h5>Muhammad Febrian Hasibuan</h5>
                        <span class="text-primary">Backend</span>
                        <ul class="team-social">
                            {{-- <li><a class="btn btn-square" href="" target="_blank"><i class="fab fa-facebook-f"></i></a></li> --}}
                            {{-- <li><a class="btn btn-square" href="" target="_blank"><i class="fab fa-twitter"></i></a></li> --}}
                            {{-- <li><a class="btn btn-square" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li> --}}
                            <li><a class="btn btn-square" href="https://www.linkedin.com/in/muhammad-febrian-hasibuan/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item rounded overflow-hidden pb-4">
                        <img class="img-fluid mb-4" src="Assets/images/team/2.jpg" alt="">
                        <h5>Putu Putra Eka Persada</h5>
                        <span class="text-primary">UI/UX Designer & Frontend</span>
                        <ul class="team-social">
                            {{-- <li><a class="btn btn-square" href="" target="_blank"><i class="fab fa-facebook-f"></i></a></li> --}}
                            {{-- <li><a class="btn btn-square" href="" target="_blank"><i class="fab fa-twitter"></i></a></li> --}}
                            {{-- <li><a class="btn btn-square" href="https://www.instagram.com/persada.studios/" target="_blank"><i class="fab fa-instagram"></i></a></li> --}}
                            <li><a class="btn btn-square" href="https://www.linkedin.com/in/putupersada/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item rounded overflow-hidden pb-4">
                        <img class="img-fluid mb-4" src="Assets/images/team/yogi.jpg" alt="">
                        <h5>Yogi Andaru</h5>
                        <span class="text-primary">Frontend</span>
                        <ul class="team-social">
                            {{-- <li><a class="btn btn-square" href="" target="_blank"><i class="fab fa-facebook-f"></i></a></li> --}}
                            {{-- <li><a class="btn btn-square" href="" target="_blank"><i class="fab fa-twitter"></i></a></li> --}}
                            {{-- <li><a class="btn btn-square" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li> --}}
                            <li><a class="btn btn-square" href="https://www.linkedin.com/in/yogi-andaru/" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

@endsection

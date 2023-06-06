<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Chemistry Program Data Center</title>

    <!-- Favicon -->
    <link href="/Assets/images/logo/color.png" rel="icon">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/Assets/auth/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/Assets/auth/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="/Assets/auth/vendors/styles/style.css" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <!-- End Google Tag Manager -->
    <style>
        .input-group.custom {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="/">
                    <img src="/Assets/images/logo/color.svg" width="50" alt="" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="{{route('auth.login')}}">Kembali</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div id="picture">
                        <img src="/Assets/auth/vendors/images/forgot-password.png" alt="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Lupa Kata Sandi</h2>
                        </div>
                        <h6 class="mb-20" style="text-align: center">
                            Masukkan alamat email Anda untuk mengatur ulang kata sandi Anda
                        </h6>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @elseif (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{route('auth.password.link.post')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group custom">
                                <input type="email" name="email" class="form-control form-control-lg @error('email') form-control-danger @enderror" placeholder="Email" />

                                <div class="input-group-append custom">
                                    @error('email')

                                    @else

                                    <span class="input-group-text"><i class="fa fa-envelope-o"
                                            aria-hidden="true"></i></span>
                                    @enderror
                                </div>
                            </div>
                            @error('email')
                                <small class="form-control-feedback mb-2 text-danger">{{ $message }}</small>
                                @enderror
                            <div class="row align-items-center mt-3">
                                <div class="col-4">
                                    <div class="input-group mb-0">
                                        <input type="submit" class="btn btn-primary btn-lg btn-block" value="Kirim" />
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="font-16 weight-600 text-center" data-color="#707373">
                                        ATAU
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block" href="{{route('auth.login')}}">Masuk</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="/Assets/auth/vendors/scripts/core.js"></script>
    <script src="/Assets/auth/vendors/scripts/script.min.js"></script>
    <script src="/Assets/auth/vendors/scripts/process.js"></script>
    <script src="/Assets/auth/vendors/scripts/layout-settings.js"></script>
    <script src="/Assets/src/js/nocopy.js"></script>
    <script>
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => input.setAttribute('autocomplete', 'off'));
    </script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
</body>

</html>

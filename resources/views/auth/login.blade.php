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
    <link rel="stylesheet" type="text/css" href="/Assets/admin/vendors/styles/style.css" />

    <!-- FontAwesome -->
    <link href="/Assets/FontAwesome/css/fontawesome.css" rel="stylesheet">
    <link href="/Assets/FontAwesome/css/brands.css" rel="stylesheet">
    <link href="/Assets/FontAwesome/css/solid.css" rel="stylesheet">
    <!-- FontAwesome -->

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

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="/">
                    <img src="/Assets/images/logo/color.svg" width="50" alt="" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="/">Kembali</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class=" col-md-6 col-lg-7">
                    <div id="">
                        <img src="/Assets/admin/vendors/images/bg-login.png" />
                    </div>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Masuk Akun</h2>
                        </div>
                        @error('status')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        <form action="{{ route('auth.login.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group custom">
                                <input name="email" value="{{ old('email') }}" type="text"
                                    class="form-control form-control-lg @error('email') form-control-danger @enderror"
                                    placeholder="Email" />
                                <div class="input-group-append custom">
                                    @error('email')
                                    @else
                                        <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                                    @enderror
                                </div>
                            </div>
                            @error('email')
                                <small class="form-control-feedback text-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group custom mt-2">
                                <input name="password" value="{{ old('password') }}" type="password"
                                    class="form-control form-control-lg @error('password') form-control-danger @enderror"
                                    placeholder="Kata Sandi" id="password-input" />
                                <div class="input-group-append custom">
                                    @error('password')
                                    @else
                                        <span class="input-group-text"
                                            onclick="togglePasswordVisibility('password-input', 'password-icon')">
                                            <i class="fas fa-eye-slash " id="password-icon"></i>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @error('password')
                                <small class="form-control-feedback text-danger">{{ $message }}</small>
                            @enderror

                            <div class="row pb-30">
                                <div class="col-12">
                                    <div class="forgot-password">
                                        <a href="{{ route('auth.password.forgot') }}">Lupa Kata Sandi?</a>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Masuk</button>
                                    </div>
                                    <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
                                        ATAU
                                    </div>
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block"
                                            href="{{ route('auth.register') }}">Daftar Akun</a>
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
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <script>
        function togglePasswordVisibility(inputId, iconId) {
            var passwordInput = document.getElementById(inputId);
            var icon = document.getElementById(iconId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye", "fa-beat");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("fa-eye", "fa-beat");
                icon.classList.add("fa-eye-slash");
            }
        }
    </script>

</body>

</html>

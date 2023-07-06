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
    <link rel="stylesheet" type="text/css" href="/Assets/admin/src/plugins/sweetalert2/sweetalert2.css" />
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
                    <li><a href="{{ route('auth.login') }}">Kembali</a></li>
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
                            <h2 class="text-center text-primary">Aktivasi Akun</h2>
                        </div>
                        <h6 class="mb-20" style="text-align: center; margin-top:-20px;">
                            Tekan Tombol kirim Jika belum menerima email dalam waktu yang cukup lama dan cek email Anda untuk aktivasi akun
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

                        <div class="col-12">
                            <div class="input-group mb-0">
                                <a href="{{ route('activation.send') }}" class="btn btn-primary btn-lg btn-block">Kirim</a>
                            </div>
                        </div>
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
    <script src="/Assets/admin/src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- Google Tag Manager (noscript) -->

    <!-- End Google Tag Manager (noscript) -->
<script>
    //sweetalert registered

    @if (session('registered'))
        swal({
            title: "Berhasil",
            text: "{{ session('registered') }}",
            type: "success",
            button: "Ok",
        });
    @elseif (session('message'))
        swal({
            title: "Berhasil",
            text: "{{ session('message') }}",
            type: "success",
            button: "Ok",
        });
    @endif
</script>
</body>
</html>

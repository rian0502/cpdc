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
                    <li><a href="#"></a></li>
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
                            <h2 class="text-center text-primary">Atur Ulang Kata Sandi</h2>
                        </div>
                        <h6 class="mb-20" style="text-align: center">Masukkan kata sandi baru Anda, konfirmasi dan
                            kirim</h6>
                            {{-- @error('email')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror --}}
                        <form action="{{route('auth.password.update.post')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group custom">
                                <input type="email" name="email" class="form-control form-control-lg @error('email') form-control-danger @enderror"
                                    placeholder="Email" />
                                    <div class="input-group-append custom">
                                    @error('email')

                                    @else
                                    <span class="input-group-text"><i class="dw dw-email"></i></span>
                                    @enderror
                                </div>
                            </div>
                            @error('email')
                                        <small class="form-control-feedback has-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group custom">
                                <input type="text" name="token" value="{{ $token }}" class="mt-2 form-control form-control-lg @error('token') form-control-danger @enderror"
                                    placeholder="Token" />
                                <div class="input-group-append custom">
                                    @error('token')

                                    @else
                                    <span class="input-group-text"><i class="dw dw-key"></i></span>
                                    @enderror
                                </div>
                            </div>
                            @error('token')
                                        <small class="form-control-feedback has-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group custom">
                                <input type="password" class="mt-2 form-control form-control-lg @error('password') form-control-danger @enderror"
                                    placeholder="Kata Sandi Baru" name="password" />
                                <div class="input-group-append custom">
                                    @error('password')
                                    @else
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                    @enderror
                                </div>
                            </div>
                            @error('password')
                                        <small class="form-control-feedback has-danger">{{ $message }}</small>
                            @enderror
                            <div class="input-group custom">
                                <input type="password" class="mt-2 form-control form-control-lg @error('password_confirmation') form-control-danger @enderror"
                                    placeholder="Konfirmai Kata Sandi Baru" name="password_confirmation"/>
                                <div class="input-group-append custom">
                                    @error('password_confirmation')
                                    @else
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                    @enderror
                                </div>
                            </div>
                            @error('password_confirmation')
                                        <small class="form-control-feedback has-danger">{{ $message }}</small>
                            @enderror
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="input-group mb-0 mt-2">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Reset">
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

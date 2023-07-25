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
    <link rel="stylesheet" type="text/css" href="/Assets/auth/src/plugins/jquery-steps/jquery.steps.css" />
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
    <style>
        .custom-checkbox {
            display: inline-block;
            vertical-align: middle;
        }

        .custom-checkbox .checkmark {
            width: 24px;
            height: 24px;
            background-color: #fff;
            border: 2px solid #ccc;
            border-radius: 5px;
            display: inline-block;
            position: relative;
            vertical-align: middle;
        }

        .custom-checkbox input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .custom-checkbox .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .custom-checkbox input[type="checkbox"]:checked+.checkmark:after {
            display: block;
        }

        .custom-checkbox .checkmark:after {
            left: 8px;
            top: 4px;
            width: 8px;
            height: 16px;
            border: solid #333;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }
    </style>

    <!-- End Google Tag Manager -->
</head>

<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="">
                    <img src="/Assets/images/logo/color.svg" width="50" alt="" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="{{ route('auth.login') }}">Masuk</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container" id="account" style="">
            <div class="row align-items-center" id="items-new">

                <div class="col-md-6 col-lg-7">
                    <div id="picture">
                        <img src="/Assets/auth/vendors/images/register-page-img.png" alt="" />
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 boxeds">
                    <div class=" bg-white box-shadow border-radius-10">
                        <div class="wizard-content">
                            <div class="pd-20 card-box mb-30 mt-lg-5" id="" style="">
                                <div class="clearfix">
                                    <div class="login-title">
                                        <h2 class="text-center text-primary">Daftar Akun</h2>
                                    </div>
                                    <h6 class="mb-lg-5 mt-3" style="text-align: center;">
                                        Silakan isi formulir di bawah ini untuk mendaftar
                                    </h6>

                                </div>
                                <form class="mt-5" action="{{ route('auth.register.post') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="profile-edit-list row">

                                        {{-- kiri --}}
                                        <div class="weight-500 col-md-6">
                                            <div class="form-group">
                                                <label for="">Alamat Email</label>
                                                <input type="email"
                                                    class="form-control @error('email') form-control-danger @enderror"
                                                    value="{{ old('email') }}" name="email" />
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Nama Lengkap</label>
                                                <input type="text" name="nama_lengkap"
                                                    value="{{ old('nama_lengkap') }}"
                                                    class="form-control @error('nama_lengkap') form-control-danger @enderror" />
                                                @error('nama_lengkap')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Angkatan</label>
                                                <input name="angkatan" value="{{ old('angkatan') }}"
                                                    class="form-control year-picker @error('angkatan') form-control-danger @enderror"
                                                    type="text">
                                                @error('angkatan')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Pembimbing Akademik</label>
                                                <select class="custom-select2 form-control "
                                                    value="{{ old('id_dosen') }}" name="id_dosen"
                                                    style="width: 100%; height: 38px">
                                                    <optgroup label="Dosen Pembimbing Akademik">
                                                        //tidak ada di daftar
                                                        <option value=""
                                                            {{ old('id_dosen') == '' ? 'selected' : '' }}>Tidak ada di
                                                            daftar</option>
                                                        @foreach ($dosen as $PA)
                                                            <option value="{{ $PA->encrypt_id }}"
                                                                {{ old('id_dosen') == $PA->encrypt_id ? 'selected' : '' }}>
                                                                {{ $PA->nama_dosen }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>

                                                </select>
                                                @error('id_dosen')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Jenis Akun</label>
                                                <div class="@error('jenis_akun') form-control-danger @enderror">
                                                    <div class="custom-control custom-radio custom-control-inline pb-0">
                                                        <input type="radio" id="mahasiswa" name="jenis_akun"
                                                            value="mahasiswa" class="custom-control-input"
                                                            {{ old('jenis_akun') == 'mahasiswa' ? 'checked' : '' }} />
                                                        <label class="custom-control-label"
                                                            for="mahasiswa">Mahasiswa</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-radio custom-control-inline pb-0">
                                                        <input type="radio" id="alumni" name="jenis_akun"
                                                            value="alumni" class="custom-control-input"
                                                            {{ old('jenis_akun') == 'alumni' ? 'checked' : '' }} />
                                                        <label class="custom-control-label"
                                                            for="alumni">Alumni</label>
                                                    </div>
                                                </div>
                                                @error('jenis_akun')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- kanan --}}

                                        <div class="weight-500 col-md-6">

                                            <div class="form-group">
                                                <label for="">NPM</label>
                                                <input type="text" name="npm" value="{{ old('npm') }}"
                                                    class="form-control @error('npm') form-control-danger @enderror" />
                                                @error('npm')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Kata Sandi</label>
                                                <input type="password" name="password" value="{{ old('password') }}"
                                                    id="password"
                                                    class="form-control @error('password') form-control-danger @enderror" />
                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="">Konfirmasi Kata Sandi</label>
                                                <input type="password" name="password_confirm"
                                                    value="{{ old('password_confirm') }}" id="password"
                                                    class="form-control @error('password_confirm') form-control-danger @enderror" />
                                                @error('password_confirm')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group" id="form" style="margin-top: -8px">
                                                <label class="weight-600"></label>
                                                <div class="custom-control custom-checkbox mb-5">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="show_password" id="show_password"
                                                        onchange="togglePasswordVisibility()" />
                                                    <label class="custom-control-label" for="show_password">
                                                        Tampilkan Kata Sandi
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Jenis Kelamin</label>
                                                <div class="@error('gender') form-control-danger @enderror">
                                                    <div
                                                        class="custom-control custom-radio custom-control-inline pb-0">
                                                        <input type="radio" id="male" name="gender"
                                                            {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}
                                                            value="Laki-laki" class="custom-control-input" />
                                                        <label class="custom-control-label"
                                                            for="male">Pria</label>
                                                    </div>
                                                    <div
                                                        class="custom-control custom-radio custom-control-inline pb-0">
                                                        <input type="radio" id="female" name="gender"
                                                            {{ old('gender') == 'Perempuan' ? 'checked' : '' }}
                                                            value="Perempuan" class="custom-control-input" />
                                                        <label class="custom-control-label"
                                                            for="female">Wanita</label>
                                                    </div>
                                                </div>
                                                @error('gender')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-12">
                                            <div class="input-group mb-0">
                                                <button type="submit"
                                                    class="btn btn-primary btn-lg btn-block">Daftar</button>
                                            </div>
                                            <div class="font-16 weight-600 pt-10 pb-10 text-center"
                                                data-color="#707373">

                                            </div>
                                            <div class="input-group mb-0">
                                                {{-- <a class="btn btn-outline-primary btn-lg btn-block"
                                            href="{{ route('auth.login') }}">Masuk Akun</a> --}}
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- js -->
    <script src="/Assets/auth/vendors/scripts/core.js"></script>
    <script src="/Assets/admin/vendors/scripts/script.min.js"></script>
    <script src="/Assets/auth/vendors/scripts/process.js"></script>
    <script src="/Assets/auth/vendors/scripts/layout-settings.js"></script>
    <script src="/Assets/auth/src/plugins/jquery-steps/jquery.steps.js"></script>
    <script src="/Assets/auth/vendors/scripts/steps-setting.js"></script>
    <script src="/Assets/src/js/nocopy.js"></script>
    <script>
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => input.setAttribute('autocomplete', 'off'));
    </script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var passwordConfirmInput = document.getElementById("password_confirm");
            var showPasswordCheckbox = document.getElementById("show_password");

            if (showPasswordCheckbox.checked) {
                passwordInput.type = "text";
                passwordConfirmInput.type = "text";
            } else {
                passwordInput.type = "password";
                passwordConfirmInput.type = "password";
            }
        }
    </script>
</body>

</html>

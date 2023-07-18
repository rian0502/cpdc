@extends('layouts.admin')
@section('admin')
    <link rel="stylesheet" href="/Assets/setting/assets/vendor/fonts/boxicons.css" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="/Assets/setting/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/Assets/setting/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />

    <!-- Vendors CSS -->
    {{-- <link rel="stylesheet" href="/Assets/setting/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" /> --}}

    <!-- Font Awesome library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Helpers -->
    <script src="/Assets/setting/assets/vendor/js/helpers.js"></script>

    <div class="main-container ms-4 me-4">
        <div class=" flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">Pengaturan</h4>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-lock me-1"></i>
                                Kata Sandi</a>
                        </li>
                        {{-- <li class="nav-item">
                                <a class="nav-link" href=""><i class="bx bx-bell me-1"></i> Notifikasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href=""><i class="bx bx-link-alt me-1"></i> Koneksi</a>
                            </li> --}}
                    </ul>
                </div>
                <div class="card mb-4">
                    <h1 class="card-header mb-3 mt-3" style="font-size: 20px;">Ubah Kata Sandi </h1>
                    <div class="card-body">
                        <form action="{{ route('auth.change.password') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="current_password">Kata Sandi Lama</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="current_password"
                                            name="current_password" value="{{ old('current_password') }}" autofocus />
                                        <button class="btn btn-outline-secondary ms-3" type="button"
                                            id="toggle_current_password">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                        @error('mitra')
                                            <div class="form-control-feedback has-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="new_password">Kata Sandi Baru</label>
                                    <div class="input-group">
                                        <input class="form-control" type="password" id="new_password" name="new_password"
                                            value="{{ old('new_password') }}" />
                                        <button class="btn btn-outline-secondary ms-3" type="button"
                                            id="toggle_new_password">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </div>
                                    @error('new_password')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="confirm_new_password">Konfirmasi Kata Sandi
                                        Baru</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="confirm_new_password"
                                            name="confirm_new_password" value="{{ old('confirm_new_password') }}" />
                                        <button class="btn btn-outline-secondary ms-3" type="button"
                                            id="toggle_confirm_new_password">
                                            <i class="fas fa-eye-slash"></i>
                                        </button>
                                    </div>
                                    @error('confirm_new_password')
                                        <div class="form-control-feedback has-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2">
                                <button id="myButton" type="submit" class="btn btn-primary me-2">Simpan</button>
                            </div>
                            {{-- <button type="reset" class="btn btn-outline-secondary">Cancel</button> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        // Toggle current password visibility
        const toggleCurrentPasswordBtn = document.getElementById('toggle_current_password');
        const currentPasswordInput = document.getElementById('current_password');

        toggleCurrentPasswordBtn.addEventListener('click', function() {
            if (currentPasswordInput.type === 'password') {
                currentPasswordInput.type = 'text';
                toggleCurrentPasswordBtn.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                currentPasswordInput.type = 'password';
                toggleCurrentPasswordBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
            }
        });

        // Toggle new password visibility
        const toggleNewPasswordBtn = document.getElementById('toggle_new_password');
        const newPasswordInput = document.getElementById('new_password');

        toggleNewPasswordBtn.addEventListener('click', function() {
            if (newPasswordInput.type === 'password') {
                newPasswordInput.type = 'text';
                toggleNewPasswordBtn.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                newPasswordInput.type = 'password';
                toggleNewPasswordBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
            }
        });

        // Toggle confirm new password visibility
        const toggleConfirmNewPasswordBtn = document.getElementById('toggle_confirm_new_password');
        const confirmNewPasswordInput = document.getElementById('confirm_new_password');

        toggleConfirmNewPasswordBtn.addEventListener('click', function() {
            if (confirmNewPasswordInput.type === 'password') {
                confirmNewPasswordInput.type = 'text';
                toggleConfirmNewPasswordBtn.innerHTML = '<i class="fas fa-eye"></i>';
            } else {
                confirmNewPasswordInput.type = 'password';
                toggleConfirmNewPasswordBtn.innerHTML = '<i class="fas fa-eye-slash"></i>';
            }
        });

        var myButton = document.getElementById("myButton");

        myButton.addEventListener("click", function() {
            myButton.classList.add("btn-pulse");

            setTimeout(function() {
                myButton.classList.remove("btn-pulse");
            }, 500);
        });
    </script>
@endsection

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

    <!-- FontAwesome -->
    <link href="/Assets/FontAwesome/css/fontawesome.css" rel="stylesheet">
    <link href="/Assets/FontAwesome/css/brands.css" rel="stylesheet">
    <link href="/Assets/FontAwesome/css/solid.css" rel="stylesheet">
    <!-- FontAwesome -->

    <!-- Helpers -->
    <script src="/Assets/setting/assets/vendor/js/helpers.js"></script>

    <div class="main-container ms-4 me-4">
        <div class=" flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">Pengaturan</h4>
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-4">
                        <li class="nav-item">
                            <a class="nav-link" href="/settings"><i class="bx bx-lock me-1"></i>
                                Kata Sandi</a>
                        </li>
                        @role('sudo')
                            <li class="nav-item">
                                <a class="nav-link active" href="#"><i class="bx bx-customize me-1"></i> Kustomisasi</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href=""><i class="bx bx-link-alt me-1"></i> Koneksi</a>
                            </li> --}}
                        @endrole
                    </ul>
                </div>
                <div class="card mb-4">
                    <h1 class="card-header mb-3 mt-3" style="font-size: 20px;">Kustomisasi Tampilan</h1>
                    <div class="card-body">
                        
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
                toggleCurrentPasswordBtn.innerHTML = '<i class="fas fa-eye fa-beat"></i>';
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
                toggleNewPasswordBtn.innerHTML = '<i class="fas fa-eye fa-beat"></i>';
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
                toggleConfirmNewPasswordBtn.innerHTML = '<i class="fas fa-eye fa-beat"></i>';
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

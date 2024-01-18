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
    <link rel="stylesheet" type="text/css"
        href="/Assets/auth/src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css"
        href="/Assets/auth/src/plugins/datatables/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="/Assets/admin/vendors/styles/style.css" />
    <link rel="stylesheet" type="text/css" href="/Assets/src/lib/toastify/src/toastify.css" />
    <link rel="stylesheet" type="text/css"
        href="/Assets/admin/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <link rel="stylesheet" type="text/css" href="/Assets/admin/src/plugins/sweetalert2/sweetalert2.css" />
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
    <style>
        .photo-profil {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
    <!-- End Google Tag Manager -->
</head>

<body class="header-white sidebar-light sidebar-shrink">
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="/Assets/images/logo/color.svg" width="100" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>
    <div class="header">
        <div class="header-left">
            <div class="menu-icon bi bi-list"></div>

        </div>
        <div class="header-right">
            <div class="dashboard-setting user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i>
                    </a>
                </div>
            </div>
            <div class="user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                        <i class="icon-copy dw dw-notification"></i>
                        <span class="badge notification-active"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="notification-list mx-h-350 customscroll">
                            <ul>
                                <li>
                                    <a href="#">
                                        <img src="/Assets/admin/src/images/img.jpg" alt="" />
                                        <h3>John Doe</h3>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing
                                            elit, sed...
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/Assets/admin/src/images/photo1.jpg" alt="" />
                                        <h3>Lea R. Frith</h3>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing
                                            elit, sed...
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/Assets/admin/src/images/photo2.jpg" alt="" />
                                        <h3>Erik L. Richards</h3>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing
                                            elit, sed...
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/Assets/admin/src/images/photo3.jpg" alt="" />
                                        <h3>John Doe</h3>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing
                                            elit, sed...
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/Assets/admin/src/images/photo4.jpg" alt="" />
                                        <h3>Renee I. Hansen</h3>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing
                                            elit, sed...
                                        </p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="/Assets/admin/src/images/img.jpg" alt="" />
                                        <h3>Vicki M. Coleman</h3>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing
                                            elit, sed...
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            {{-- <img src="/Assets/images/profile_picture/default.png" alt="" /> --}}
                            <img src="/uploads/profile/{{ Auth::user()->profile_picture }}"
                                onerror="this.src='/uploads/profile/default.png'" alt="" class="photo-profil" />
                        </span>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">

                        <a class="dropdown-item" href="/logout"><i class="dw dw-logout"></i> Keluar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="right-sidebar">
        <div class="sidebar-title">
            <h3 class="weight-600 font-16 text-blue">
                Layout Settings
                <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
            </h3>
            <div class="close-sidebar" data-toggle="right-sidebar-close">
                <i class="icon-copy ion-close-round"></i>
            </div>
        </div>
        <div class="right-sidebar-body customscroll">
            <div class="right-sidebar-body-content">
                <h4 class="weight-600 font-18 pb-10">Header Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
                <div class="sidebar-radio-group pb-10 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon"
                            class="custom-control-input" value="icon-style-1" checked="" />
                        <label class="custom-control-label" for="sidebaricon-1"><i
                                class="fa fa-angle-down"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon"
                            class="custom-control-input" value="icon-style-2" />
                        <label class="custom-control-label" for="sidebaricon-2"><i
                                class="ion-plus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon"
                            class="custom-control-input" value="icon-style-3" />
                        <label class="custom-control-label" for="sidebaricon-3"><i
                                class="fa fa-angle-double-right"></i></label>
                    </div>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
                <div class="sidebar-radio-group pb-30 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-1" name="menu-list-icon"
                            class="custom-control-input" value="icon-list-style-1" checked="" />
                        <label class="custom-control-label" for="sidebariconlist-1"><i
                                class="ion-minus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-2" name="menu-list-icon"
                            class="custom-control-input" value="icon-list-style-2" />
                        <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o"
                                aria-hidden="true"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-3" name="menu-list-icon"
                            class="custom-control-input" value="icon-list-style-3" />
                        <label class="custom-control-label" for="sidebariconlist-3"><i
                                class="dw dw-check"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-4" name="menu-list-icon"
                            class="custom-control-input" value="icon-list-style-4" checked="" />
                        <label class="custom-control-label" for="sidebariconlist-4"><i
                                class="icon-copy dw dw-next-2"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-5" name="menu-list-icon"
                            class="custom-control-input" value="icon-list-style-5" />
                        <label class="custom-control-label" for="sidebariconlist-5"><i
                                class="dw dw-fast-forward-1"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-6" name="menu-list-icon"
                            class="custom-control-input" value="icon-list-style-6" />
                        <label class="custom-control-label" for="sidebariconlist-6"><i
                                class="dw dw-next"></i></label>
                    </div>
                </div>

                <div class="reset-options pt-30 text-center">
                    <button class="btn btn-danger" id="reset-settings">
                        Reset Settings
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="left-side-bar open">
        <div class="brand-logo">
            <a href="/" class="text-dark">

                <img src="/Assets/images/logo/color-text.png" width="" alt="Logo CPDC">
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>

    </div>
    <div class="mobile-menu-overlay show">


    </div>
    <div id="toast"></div>
    @yield('blank')



    <!-- js -->
    <script src="/Assets/admin/vendors/scripts/core.js"></script>
    <script src="/Assets/admin/vendors/scripts/script.min.js"></script>
    <script src="/Assets/admin/vendors/scripts/process.js"></script>
    <script src="/Assets/admin/vendors/scripts/layout-settings.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="/Assets/admin/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="/Assets/admin/vendors/scripts/dashboard3.js"></script>
    <script src="/Assets/src/lib/toastify/src/toastify.js"></script>
    <script src="/Assets/admin/src/plugins/sweetalert2/sweetalert2.all.js"></script>
    <script src="/Assets/admin/src/plugins/sweetalert2/sweet-alert.init.js"></script>
    <!-- bootstrap-tagsinput js -->
    <script src="/Assets/admin/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="/Assets/src/js/nocopy.js"></script>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>

    <!-- Tambahkan HTML untuk menampilkan notifikasi -->


    <!-- Tambahkan script untuk menampilkan notifikasi -->
    <script>
        @if (session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#1abc9c",
                stopOnFocus: true,
            }).showToast();
        @elseif (session('error'))
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                gravity: "bottom",
                position: "right",
                backgroundColor: "#e74c3c",
                stopOnFocus: true,
            }).showToast();
        @elseif (session('message'))
            Toastify({
                text: "{{ session('message') }}",
                duration: 3000,
                gravity: "top",
                position: "center",
                backgroundColor: "#3498db",
                stopOnFocus: true,
            }).showToast();
        @endif
    </script>
    <script>
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => input.setAttribute('autocomplete', 'off'));
    </script>
    <script>
        function showConfirmationForm() {
            swal({
                title: 'Apakah Anda yakin ingin submit data ini ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    document.getElementById('formStatus').submit();
                }
            })
        }

        // Mengambil elemen tombol submit
        const submitButton = document.getElementById('submitButton');

        // Menangani klik tombol submit
        submitButton.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah pengiriman form secara langsung

            // Panggil fungsi untuk menampilkan konfirmasi
            showConfirmationForm();
        });
    </script>
    <!-- End Google Tag Manager (noscript) -->


    <script>
        function toggleInput(selectElement, targetId, targetId2) {
            var selectedValue = selectElement.value;
            var targetElement2 = document.getElementById(targetId2);
            var targetElement = document.getElementById(targetId);
            if (selectedValue === "new") {
                targetElement.style.display = "block";
                targetElement2.style.display = "block";
                targetElement.hidden = false;
                targetElement2.hidden = false;
            } else {
                targetElement.style.display = "none";
                targetElement2.style.display = "none";
                targetElement.hidden = true;
                targetElement2.hidden = true;
            }
        }
    </script>
    @role('kompre|ta2|ta1|pkl')
        <script>
            $(document).ready(function() {
                $('#formJadwal').submit(function(e) {
                    e.preventDefault();
                    var request = new FormData(this);
                    var endpoint = '/api/check-jadwal';
                    $.ajax({
                        url: endpoint,
                        method: "POST",
                        data: request,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            if (data['message'] == 'Valid') {
                                swal({
                                    title: "Berhasil",
                                    text: "Jadwal Bisa digunakan",
                                    type: "question",
                                    showCancelButton: true,
                                    confirmButtonText: "Ya, Buat Jadwal",
                                }).then(function(result) {
                                    if (result.value) {
                                        $('#formJadwal').unbind('submit').submit();
                                    }
                                });
                            } else {
                                swal({
                                    title: "Gagal",
                                    text: "Jadwal yang anda masukkan sudah terdaftar",
                                    type: "error",
                                    button: "Ok",
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status >= 500) {
                                swal({
                                    title: "Gagal",
                                    text: "Sistem Error",
                                    type: "error",

                                });
                            } else {
                                var error_data = JSON.parse(xhr.responseText)['errors'];
                                var error_msg = "";
                                for (var key in error_data) {
                                    error_msg += error_data[key] + ",";
                                }
                                swal({
                                    title: "Gagal",
                                    text: error_msg,
                                    type: "error",
                                });
                            }
                        },
                    });
                });
            });
        </script>
    @endrole
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Menangkap semua form di halaman
            const forms = document.querySelectorAll('form');
    
            forms.forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    // Menonaktifkan tombol submit untuk mencegah pengiriman ganda
                    const submitButton = form.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.disabled = true;
                    }
                    
                    // Tambahkan indikator loading jika diperlukan
                    // Misalnya, tampilkan pesan loading atau animasi loading
    
                    // Atur delay agar tombol submit tidak tetap dinonaktifkan selamanya
                    setTimeout(function () {
                        if (submitButton) {
                            submitButton.disabled = false;
                        }
                    }, 5000); // Ganti 5000 dengan waktu delay yang sesuai
                });
            });
        });
    </script>
    
</body>

</html>

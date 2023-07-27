
        // Variabel global untuk menyimpan status cropping
        var cropper;
        var originalImageSrc;
        var croppingInProgress = false;
        var croppedImageData; // Variabel untuk menyimpan data gambar yang sudah di-crop

        // Fungsi untuk menampilkan modal cropping
        function showImageCropModal() {
            $('#imageCropModal').modal('show');
        }

        // Fungsi untuk menyembunyikan modal cropping
        function hideImageCropModal() {
            $('#imageCropModal').modal('hide');
        }

        // Fungsi untuk memuat gambar sebelum dilakukan cropping
        function previewFile(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function() {
                var dataURL = reader.result;

                // Tampilkan gambar di modal cropping
                var image = document.getElementById('cropperImage');
                image.src = dataURL;

                // Tampilkan modal cropping setelah gambar dipilih
                showImageCropModal();

                // Simpan sumber gambar asli untuk jika reseleksi gambar
                originalImageSrc = image.src;

                // Inisialisasi Cropper.js setelah gambar dimuat
                cropper = new Cropper(image, {
                    aspectRatio: 1, // Anda dapat menyesuaikan aspek rasio sesuai kebutuhan
                    viewMode: 1,
                    responsive: true,
                    cropBoxResizable: true
                });

                // Tampilkan tombol "Crop" dan sembunyikan tombol "Crop Again"
                document.getElementById('cropButton').style.display = 'block';
                document.getElementById('cropAgainButton').style.display = 'none';

                // Set status cropping menjadi true
                croppingInProgress = true;
            };

            reader.readAsDataURL(input.files[0]);
        }

        // Fungsi untuk melakukan cropping gambar
        function cropImage() {
            if (cropper) {
                var canvas = cropper.getCroppedCanvas();
                croppedImageData = canvas.toDataURL(); // Data gambar yang sudah di-crop dalam format base64

                // Perbarui tampilan gambar dengan gambar hasil cropping
                var previewImage = document.getElementById('preview-image');
                previewImage.src = croppedImageData;

                // Sembunyikan modal setelah cropping
                hideImageCropModal();

                // Tampilkan tombol "Crop Again" dan sembunyikan tombol "Crop"
                document.getElementById('cropButton').style.display = 'none';
                document.getElementById('cropAgainButton').style.display = 'block';

                // Set status cropping menjadi false
                croppingInProgress = false;
            }
        }

        // Fungsi untuk mereset gambar menjadi gambar asli untuk cropping ulang
        function cropAgain() {
            // Tampilkan modal cropping setelah reseleksi
            showImageCropModal();

            // Inisialisasi Cropper.js dengan gambar asli
            var image = document.getElementById('cropperImage');
            image.src = originalImageSrc;

            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                responsive: true,
                cropBoxResizable: true
            });

            // Tampilkan tombol "Crop" dan sembunyikan tombol "Crop Again"
            document.getElementById('cropButton').style.display = 'block';
            document.getElementById('cropAgainButton').style.display = 'none';

            // Set status cropping menjadi true
            croppingInProgress = true;
        }

        // Tambahkan event handler untuk menyembunyikan modal cropping ketika modal ditutup
        $('#imageCropModal').on('hidden.bs.modal', function() {
            if (croppingInProgress) {
                hideImageCropModal();
                croppingInProgress = false;
            }
        });

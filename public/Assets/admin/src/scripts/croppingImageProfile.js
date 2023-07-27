
  // Variabel global untuk menyimpan status cropping
  var cropper;
  var originalImageSrc;
  var croppingInProgress = false;
  var croppedImageData; // Variabel untuk menyimpan data gambar yang sudah di-crop

  // Fungsi untuk menampilkan modal cropping
  function showImageCropModal() {
    $("#imageCropModal").modal("show");
  }

  // Fungsi untuk menyembunyikan modal cropping
  function hideImageCropModal() {
    $("#imageCropModal").modal("hide");
  }

  // Fungsi untuk memuat gambar sebelum dilakukan cropping
  function previewFile(event) {
    var input = event.target;
    var reader = new FileReader();

    reader.onload = function() {
      var dataURL = reader.result;

      // Simpan sumber gambar asli untuk jika reseleksi gambar
      originalImageSrc = dataURL;

      // Tampilkan gambar di modal cropping
      var image = document.getElementById("cropperImage");
      image.src = dataURL;

      // Tampilkan modal cropping setelah gambar dipilih
      showImageCropModal();

      // Inisialisasi Cropper.js setelah gambar dimuat
      if (cropper) {
        cropper.destroy(); // Hapus instansi Cropper sebelumnya jika ada
      }
      cropper = new Cropper(image, {
        aspectRatio: 1, // Anda dapat menyesuaikan aspek rasio sesuai kebutuhan
        viewMode: 1,
        responsive: true,
        cropBoxResizable: true,
      });

      // Tampilkan tombol "Crop" dan sembunyikan tombol "Crop Again"
      document.getElementById("cropButton").style.display = "block";
      document.getElementById("cropAgainButton").style.display = "none";
    };

    reader.readAsDataURL(input.files[0]);
  }

  // Fungsi untuk melakukan cropping gambar
  // Fungsi untuk melakukan cropping gambar
// Fungsi untuk melakukan cropping gambar
function cropImage() {
    if (cropper) {
      var canvas = cropper.getCroppedCanvas();
      croppedImageData = canvas.toDataURL(); // Data gambar yang sudah di-crop dalam format base64

      // Perbarui tampilan gambar dengan gambar hasil cropping
      var previewImage = document.getElementById("preview-image");
      previewImage.src = croppedImageData;

      // Simpan hasil cropping ke file gambar baru dalam bentuk Blob
      var croppedFile = dataURLtoFile(croppedImageData, "cropped_image.png"); // 'cropped_image.png' is the desired filename

      // Create a new FileList containing the croppedFile
      var newFileList = new DataTransfer();
      newFileList.items.add(croppedFile);

      // Set the new FileList as the value of the file input
      var input = document.getElementById("foto_profile");
      input.files = newFileList.files;

      // Sembunyikan modal setelah cropping
      hideImageCropModal();

      // Tampilkan tombol "Crop Again" dan sembunyikan tombol "Crop"
      document.getElementById("cropButton").style.display = "none";
      document.getElementById("cropAgainButton").style.display = "block";

      // Set status cropping menjadi false
      croppingInProgress = false;
    }
  }



  // Fungsi untuk mereset gambar menjadi gambar asli untuk cropping ulang
  function cropAgain() {
    // Tampilkan modal cropping setelah reseleksi
    showImageCropModal();

    // Inisialisasi Cropper.js dengan gambar asli
    var image = document.getElementById("cropperImage");
    image.src = originalImageSrc;

    cropper = new Cropper(image, {
      aspectRatio: 1,
      viewMode: 1,
      responsive: true,
      cropBoxResizable: true,
    });

    // Tampilkan tombol "Crop" dan sembunyikan tombol "Crop Again"
    document.getElementById("cropButton").style.display = "block";
    document.getElementById("cropAgainButton").style.display = "none";

    // Set status cropping menjadi true
    croppingInProgress = true;
  }

  // Fungsi untuk mengkonversi data URL menjadi File
  function dataURLtoFile(dataURL, fileName) {
    var arr = dataURL.split(",");
    var mime = arr[0].match(/:(.*?);/)[1];
    var bstr = atob(arr[1]);
    var n = bstr.length;
    var u8arr = new Uint8Array(n);
    while (n--) {
      u8arr[n] = bstr.charCodeAt(n);
    }
    return new File([u8arr], fileName, { type: mime });
  }

  // Tambahkan event handler untuk menyembunyikan modal cropping ketika modal ditutup
  $("#imageCropModal").on("hidden.bs.modal", function() {
    if (croppingInProgress) {
      hideImageCropModal();
      croppingInProgress = false;
    }
  });


// Simpan gambar asli dalam variabel
var originalImage = document.querySelector("#logo").src;

// Atur properti transisi pada elemen gambar
document.querySelector("#logo").style.transition = "all 0.3s ease";

// Mengganti gambar saat hovering pada elemen dengan class kampus
document.querySelector(".kampus").addEventListener("mouseover", function () {
    document.querySelector("#logo").src = "/Assets/images/logo/unila.png";
});

// Mengganti gambar saat tidak hovering pada elemen dengan class kampus
document.querySelector(".kampus").addEventListener("mouseout", function () {
    document.querySelector("#logo").src = originalImage;
});

// Mengganti gambar saat hovering pada elemen dengan class bentuk
document.querySelector(".bentuk").addEventListener("mouseover", function () {
    document.querySelector("#logo").src = "/Assets/images/logo/lingkaran.png";
});

// Mengganti gambar saat tidak hovering pada elemen dengan class bentuk
document.querySelector(".bentuk").addEventListener("mouseout", function () {
    document.querySelector("#logo").src = originalImage;
});

// Mengganti gambar saat hovering pada elemen dengan class abjad
document.querySelector(".abjad").addEventListener("mouseover", function () {
    document.querySelector("#logo").src = "/Assets/images/logo/s.png";
});

// Mengganti gambar saat tidak hovering pada elemen dengan class abjad
document.querySelector(".abjad").addEventListener("mouseout", function () {
    document.querySelector("#logo").src = originalImage;
});

// Mengganti gambar saat hovering pada elemen dengan class warnanya
document.querySelector(".warnanya").addEventListener("mouseover", function () {
    document.querySelector("#logo").src = "/Assets/images/logo/biru.png";
});

// Mengganti gambar saat tidak hovering pada elemen dengan class warnanya
document.querySelector(".warnanya").addEventListener("mouseout", function () {
    document.querySelector("#logo").src = originalImage;
});

// menampilkan tanggal
function tampilkanTanggal() {
    var tanggal = new Date();
    var options = {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    };
    var tanggalIndonesia = tanggal.toLocaleDateString("id-ID", options);

    document.querySelector(".tanggal").textContent = tanggalIndonesia;
}

tampilkanTanggal();

// menampilkan tanggal



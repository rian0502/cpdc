// Membuat array nama-nama hari
var hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

// Membuat array nama-nama bulan
var bulan = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember",
];

// Mendapatkan tanggal saat ini
var tanggalSekarang = new Date();

// Mendapatkan hari saat ini
var hariIni = hari[tanggalSekarang.getDay()];

// Mendapatkan tanggal saat ini
var tanggal = tanggalSekarang.getDate();

// Mendapatkan bulan saat ini
var bulanIni = bulan[tanggalSekarang.getMonth()];

// Mendapatkan tahun saat ini
var tahun = tanggalSekarang.getFullYear();

// Menampilkan hari, tanggal, bulan, dan tahun dalam format Indonesia
var tanggalElement = document.getElementById("tanggal");
tanggalElement.innerHTML =
    hariIni +
    ", " +
    ("0" + tanggal).slice(-2) +
    "-" +
    ("0" + (tanggalSekarang.getMonth() + 1)).slice(-2) +
    "-" +
    tahun;

// Mengubah gaya font
tanggalElement.style.fontFamily = "'Montserrat', sans-serif";

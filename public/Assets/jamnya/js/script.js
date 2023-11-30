
// var horas = document.getElementById("horas");
// var minutos = document.getElementById("minutos");
// var segundos = document.getElementById("segundos");

// function relogio() {
//     var data = new Date();
//     var hor = data.getHours();
//     var min = data.getMinutes();
//     var sec = data.getSeconds();

//     if(hor<10) { hor = "0" + hor};
//     if(min<10) { min = "0" + min};
//     if(sec<10) { sec = "0" + sec};

//     horas.textContent = hor;
//     minutos.textContent = min;
//     segundos.textContent = sec;
// }
// setInterval(relogio, 1000);

var horas = document.getElementById("horas");
var minutos = document.getElementById("minutos");
var segundos = document.getElementById("segundos");
var dataCompleta = document.getElementById("dataCompleta");

function relogio() {
    var data = new Date();
    var hor = data.getHours();
    var min = data.getMinutes();
    var sec = data.getSeconds();
    var dia = data.getDate();
    var mes = data.getMonth() + 1; // Perhatikan bahwa indeks bulan dimulai dari 0, jadi perlu ditambah 1.
    var ano = data.getFullYear();

    if (hor < 10) {
        hor = "0" + hor;
    }
    if (min < 10) {
        min = "0" + min;
    }
    if (sec < 10) {
        sec = "0" + sec;
    }

    horas.textContent = hor;
    minutos.textContent = min;
    segundos.textContent = sec;

    var options = {
        day: "numeric",
        month: "long",
        year: "numeric",
        timeZone: "UTC",
    };
    var formatter = new Intl.DateTimeFormat("id-ID", options);
    var formattedDate = formatter.format(data);
    dataCompleta.textContent = formattedDate;
}

setInterval(relogio, 1000);

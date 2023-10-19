document.addEventListener("DOMContentLoaded", function () {
    var elements = document.getElementsByClassName("no-copy");
    for (var i = 0; i < elements.length; i++) {
        elements[i].addEventListener("copy", function (event) {
            event.preventDefault();
            var selection = window.getSelection();
            selection.removeAllRanges();
            alert("Penyalinan tidak diizinkan.");
        });
    }
});

function exportToXLSX() {
    // Get table data
    var table = document.getElementById("table-data");
    var rows = table.getElementsByTagName("tr");

    // Create XLSX file
    var wb = XLSX.utils.book_new();
    var ws = XLSX.utils.table_to_sheet(table);
    XLSX.utils.book_append_sheet(wb, ws, "Sheet1");

    // Download XLSX file
    var wbout = XLSX.write(wb, { bookType: "xlsx", type: "binary" });
    function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xff;
        return buf;
    }
    saveAs(
        new Blob([s2ab(wbout)], { type: "application/octet-stream" }),
        "table-data.xlsx"
    );
}

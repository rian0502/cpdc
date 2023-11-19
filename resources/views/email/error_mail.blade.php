<!DOCTYPE html>
<html>

<head>
    <title>{{ $data['title'] }}</title>
</head>

<body>
    <h3>Kepada Ketua Jurusan : {{ $data['nama'] }}</h3>
    <p>Telah Terjadi Error Pada Proses Import Data, Berikut Errornya :  </p>
    <p>{{ $data['messages'] }}</p>

</body>

</html>

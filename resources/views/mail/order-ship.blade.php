<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card w-75">
            <div class="card-body text-center fs-5 text-center">
                <p class="fs-2 fw-semibold text-success">Informasi Pengingat</p>
                <h3 class="fw-bold text-warning">Perpustakaan</h3>
                <img src="http://127.0.0.1:8000/assets/img/logo.png" alt="gambar" width="120">
                <h4 class="mt-3">Halo, <span class="text-primary fw-bolder">{!! $name !!}</span></h4>
                <p>Peminjaman buku dengan nomor
                    <span class="fw-bold text-danger">#{!! $created_at->format('dmY').$id !!}</span>
                    akan segera berakhir pada tanggal</p>

                <p>Silahkan mengembalikan buku sebelum waktu peminijaman berakhir</p>

                <p>Silahkan <a href="" class="link-warning text-decoration-underline">Klik Disini</a> dan pilih login untuk melihat informasi peminjaman </p>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

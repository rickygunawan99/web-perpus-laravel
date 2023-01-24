<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('admin.partials.style-part')
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="shortcut icon" href="/assets/img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Dashboard</title>

    <link href="/assets/css/app.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap"
        rel="stylesheet"
    />

    <title>Admin</title>
</head>

<body>
<div class="wrapper">
    @include('admin.partials.sidebar-part', ['confirm_return' => 'true'])
    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">
                <div class="container mt-4">
                    <h4 class="mb-3 text-center">Daftar detail buku</h4>
                    <div class="mb-3">
                        <label class="form-label"><b>ID Pinjaman</b></label>
                        <input type="text" class="form-control" value="{{$cart->id}}" disabled>
                    </div>
                    <form action="" method="POST">
                        <section id="#buku">
                            @foreach($cart->books as $row)
                                <div class="mb-3">
                                    <label class="form-label"><b>Judul Buku {{$loop->iteration}}</b></label>
                                    <input type="text" name="nama-penerbit" class="form-control" value="{{$row->title}}" disabled>
                                </div>
                            @endforeach
                        </section>

                        <div class="mb-3">
                            <label class="form-label"><b>Denda</b></label>
                            <input type="number" name="denda" class="form-control" placeholder="Masukan denda jika ada">
                        </div>
                        <div class="mt-5 text-center">
                            <a href="/" class="btn btn-secondary">Back</a>
                            <button type="submit" name="simpan-buku-submit" class="btn btn-success">Simpan</button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

</body>


@include('admin.partials.script-part')
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('admin.partials.style-part')

    <title>Konfirmasi pengembalian</title>
</head>

<body>
@include('admin.partials.navbar-part')

<div class="container mt-4">
    <h4 class="mb-3 text-center">Daftar detail buku</h4>
    <div class="mb-3">
        <label class="form-label"><b>ID Pinjaman</b></label>
        <input type="text" class="form-control" value="{{$cart->id}}" disabled>
    </div>
    <form action="{{route("admin.add-book")}}" method="POST">
        <section id="#buku">
            @foreach($cart->books as $row)
                <div class="mb-3">
                    <label class="form-label"><b>Judul Buku</b></label>
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

</body>

</html>

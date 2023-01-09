<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('admin.partials.style-part');

    <title>Admin</title>
</head>

<body>
@include('admin.partials.navbar-part');

<div class="container mt-4">
    <section class="text-center">
        <h2>EDIT BUKU</h2>
    </section>

    <form action="{{route("admin.add-book")}}" method="POST">
        <div class="mb-3">
            <label for="judulBuku" class="form-label @error('judul-buku') is-invalid @enderror"><b>Judul Buku</b></label>
            <input type="text" name="judul-buku" class="form-control" id="judulBuku" placeholder="Masukan Judul Buku" value=" {{$book->title ?? ''}}">
            @error('judul-buku')
                <div class="invalid-feedback">
                    <p>{{ $message }}</p>
                </div>
            @enderror
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="jmlHalBuku" class="form-label @error('jml-halaman') is-invalid @enderror"><b>Jumlah Halaman</b></label>
                    <input type="number" name="jml-halaman" class="form-control" id="jmlHalBuku" placeholder="Masukan Jumlah Halaman" value="{{$book->total_page ?? ''}}">
                    @error('jml-halaman')
                    <div class="invalid-feedback">
                        <p>{{ $message }}</p>
                    </div>
                    @enderror
                </div>
            </div>

            <div class="col">
                <div class="mb-3">
                    <label for="kategori" class="form-label "><b>Kategori Buku</b></label>
                    <select class="form-select" aria-label="Kategori" name="kategori">
                        @foreach($categories as $category)
                            <option value="{{$category->id_category}}" selected=" {{$book->category->name ?? ''}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
        <hr>
        <section id="#penulis-form">
            @foreach($book->author as $author)
                <div class="mb-3">
                    <label class="form-label @error('nama-penerbit') is-invalid @enderror"><b>Nama Penulis</b></label>
                    <input type="text" name="nama-penerbit" class="form-control" placeholder="Masukan Nama Penerbit" value="{{$author->name ?? ''}}">
                    @error('nama-penerbit')
                    <div class="invalid-feedback">
                        <p>{{ $message }}</p>
                    </div>
                    @enderror
                </div>
            @endforeach
        </section>
        {{--            <div class="text-end">--}}
        {{--                <a class="link-info text-decoration-none" href="#tambah-penulis" onclick="add_penulis()">+ Tambah Penulis Lain.</a>--}}
        {{--            </div>--}}
        <div class="mb-3 penulis-input">
            <label class="form-label @error('nama-penulis-1') is-invalid @enderror"><b>Nama Penerbit</b></label>
            <input type="text" name="nama-penulis-1" class="form-control" placeholder="Masukan Nama Penulis" value=" {{$book->publisher->name ?? ''}}">
            @error('nama-penulis-1')
            <div class="invalid-feedback">
                <p>{{ $message }}</p>
            </div>
            @enderror
        </div>

        <div class="mt-5 text-center">
            <button type="submit" name="simpan-buku-submit" class="btn btn-success">Simpan</button>
        </div>
        @csrf
    </form>
</div>

</body>

<script>
    function add_penulis() {
        let num = document.getElementsByClassName("penulis-input").length;

        const tag_div = document.createElement("div");
        tag_div.setAttribute("class", "mb-3 penulis-input");

        const label = document.createElement("label");
        label.setAttribute("class", "form-label");
        label.innerHTML = "<b>Nama Penulis " + (num + 1) + "</b>";
        const input = document.createElement("input");
        input.setAttribute("type", "text");
        input.setAttribute("name", "nama-penulis-" + (num + 1));
        input.setAttribute("class", "form-control");
        input.setAttribute("placeholder", "Masukan Nama Penulis " + (num + 1));

        tag_div.appendChild(label);
        tag_div.appendChild(input);

        const parent = document.getElementById("#penulis-form");

        parent.appendChild(tag_div);
    }
</script>

</html>

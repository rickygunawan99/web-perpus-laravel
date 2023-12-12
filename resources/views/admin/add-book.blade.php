@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Buku')

@section('page-script')
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
            input.setAttribute("name", "nama-penulis[" + (num+1) + "]");
            input.setAttribute("class", "form-control");
            input.setAttribute("placeholder", "Masukan Nama Penulis " + (num + 1));

            tag_div.appendChild(label);
            tag_div.appendChild(input);

            const parent = document.getElementById("#penulis-form");

            parent.appendChild(tag_div);
        }
    </script>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="row">
                    <div class="col-12">
                        <div class="container mt-4">
                            <section class="text-start">
                                <h4>Tambahkan buku baru</h4>
                            </section>

                            <form action="{{route("admin.add-book")}}" method="POST" name="authors" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="judulBuku" class="form-label @error('judul-buku') is-invalid @enderror"><b>Judul</b></label>
                                    <input type="text" name="judul-buku" class="form-control" id="judulBuku" placeholder="Masukan Judul Buku"
                                           value="{{old('judul-buku') ?? ''}}">
                                    @error('judul-buku')
                                    <div class="invalid-feedback">
                                        <p>{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="judulBuku" class="form-label @error('judul-buku') is-invalid @enderror"><b>Deskripsi</b></label>
                                    <textarea name="deskripsi" class="form-control" id="deskripsi" placeholder="Masukan Deskripsi"
                                              value="{{old('deskripsi') ?? ''}}"></textarea>
                                    @error('deskripsi')
                                    <div class="invalid-feedback">
                                        <p>{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="jmlHalBuku" class="form-label @error('jml-halaman') is-invalid @enderror"><b>Jumlah Halaman</b></label>
                                            <input type="number" name="jml-halaman" class="form-control" id="jmlHalBuku" placeholder="Masukan Jumlah Halaman" value="{{old('jml-halaman')}}">
                                            @error('jml-halaman')
                                            <div class="invalid-feedback">
                                                <p>{{ $message }}</p>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label"><b>Kategori</b></label>
                                            <select class="form-select" aria-label="Kategori" name="kategori">
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id_category}}">{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <section id="#penulis-form">
                                    <div class="mb-3 penulis-input">
                                        <label class="form-label @error('nama-penulis-1') is-invalid @enderror"><b>Nama Penulis</b></label>
                                        <input type="text" name="nama-penulis[0]" class="form-control" placeholder="Masukan Nama Penulis 1">
                                        @error('nama-penulis-1')
                                        <div class="invalid-feedback">
                                            <p>{{ $message }}</p>
                                        </div>
                                        @enderror
                                    </div>
                                </section>
                                <div class="text-end">
                                    <a class="link-primary text-decoration-none" href="#tambah-penulis" onclick="add_penulis()">+ Tambah Penulis Lain.</a>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label @error('nama-penerbit') is-invalid @enderror"><b>Nama Penerbit</b></label>
                                    <input type="text" name="nama-penerbit" class="form-control" placeholder="Masukan Nama Penerbit">
                                    @error('nama-penerbit')
                                    <div class="invalid-feedback">
                                        <p>{{ $message }}</p>
                                    </div>
                                    @enderror
                                </div>

                                {{--                                    <div class="mb-3">--}}
                                {{--                                        <div class="row w-50">--}}
                                {{--                                            <div class="">--}}
                                {{--                                                <img id="thumb" src="{{asset('/storage/upload.jpg')}}" width="200" height="300">--}}
                                {{--                                                <input type="file" class="form-control mt-2" onchange="preview()" name="image-upload" id="image-upload">--}}
                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}

                                <div class="mt-5">
                                    <button type="submit" name="simpan-buku-submit" class="btn btn-success">Simpan</button>
                                </div>
                                @csrf
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

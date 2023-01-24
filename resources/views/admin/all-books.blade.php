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
    @include('admin.partials.sidebar-part', ['all_book' => 'true'])

    <div class="main">
        <main class="content">
            <div class="container-fluid p-0">
                @if(Session::has('success'))
                    <div class="alert alert-success w-50 mx-auto" role="alert">
                        {{Session::get('success')}}
                    </div>
                @endif

                @if(Session::has('failed'))
                    <div class="alert alert-danger w-50 mx-auto" role="alert">
                        {{Session::get('failed')}}
                    </div>
                @endif
                <h1 class="h3">Dashboard</h1>
                <div class="row">
                    <div class="row">
                        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">All Books</h5>
                                </div>
                                <table class="table table-hover my-0 w-100">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Kategori</th>
                                        {{--                        <th scope="col">Penulis</th>--}}
                                        <th scope="col">Penerbit</th>
                                        {{--                        <th scope="col">Stok</th>--}}
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($books as $book)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td class="d-none d-xl-table-cell"> {{$book->title}}</td>
                                            <td class="d-none d-xl-table-cell" >{{$book->category->category_name}}</td>
                                            {{--                            <td>{{$book->author->name}}</td>--}}
                                            <td class="d-none d-xl-table-cell">{{$book->publisher->name}}</td>
                                            {{--                            <td>{{$book->stock ?? 'N/A'}}</td>--}}
                                            <td>
                                                <a href="{{route('book.update.store', ['id'=>$book->id_book])}}" class="btn btn-primary btn-sm"><i class="bi bi-pen"></i></a>
                                                <button type="submit" class="btn btn-danger btn-sm open-modal-hapus-buku" data-bs-toggle="modal" data-bs-target="#hapusBukuModal"
                                                        data-id="{{$book->id_book}}"><i class="bi bi-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{$books->links()}}
        </main>
        @
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="hapusBukuModal" tabindex="-1" aria-labelledby="hapusBukuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusBukuModalLabel">Hapus Buku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Yakin Ingin Menghapus Buku ini ?
            </div>
            <div class="modal-footer">
                <form action="{{route('book.destroy')}}" method="post">
                    @csrf
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <input type="text" name="hapus-buku-id" id="hapus-buku-id" value="" hidden />
                    <button type="submit" name="hapus-submit" class="btn btn-primary">Ya</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>


@include('admin.partials.script-part')

<script>

    $(document).on("click", ".open-modal-hapus-buku", function() {
        const myBookId = $(this).data('id');
        $(".modal-footer #hapus-buku-id").val(myBookId);
        // As pointed out in comments,
        // it is unnecessary to have to manually call the modal.
        // $('#addBookDialog').modal('show');
    });

</script>
</html>

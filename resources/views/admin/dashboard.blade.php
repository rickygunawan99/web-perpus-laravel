<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('admin.partials.style-part');

    <title>Admin</title>
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
</head>

<body>
    @include('admin.partials.navbar-part');

    <div class="container mt-4">
        <section class="text-end">
            <a href="{{route('admin.add-book')}}" class="btn btn-success">+ Tambah Buku</a>
        </section>

        <section class="mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $buku)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$buku->title}}</td>
                            <td>{{$buku->category_id}}</td>
                            <td>{{$buku->author->name}}</td>
                            <td>{{$buku->publisher_id}}</td>
                            <td>{{$buku->stock}}</td>
                            <td>
                                <a href="{{route('book.update.store', ['id'=>$buku->id_book])}}" class="btn btn-primary btn-sm"><i class="bi bi-pen"></i></a>
                                <button type="submit" class="btn btn-danger btn-sm open-modal-hapus-buku" data-bs-toggle="modal" data-bs-target="#hapusBukuModal"
                                        data-id="{{$buku->id_book}}"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
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
@include('admin.partials.script-part');

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

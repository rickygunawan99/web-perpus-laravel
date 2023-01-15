<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('admin.partials.style-part')

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
@include('admin.partials.navbar-part')
<div class="container mt-4">
    <section class="mt-4">
        <table class="table table-responsive w-50 mx-auto table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Total Day</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart as $row)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$row->total_day}} day</td>
                    <td>
                        <a href="{{route('admin.cart.detail', ['cart'=>$row->id])}}" class="btn btn-success btn-sm"><i class="bi bi-pen"> Konfirmasi pengembalian</i></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </section>
</div>

<script>
    $(document).on("click", ".open-modal-hapus-buku", function() {
        const myBookId = $(this).data('id');
        $(".modal-footer #hapus-buku-id").val(myBookId);
        // As pointed out in comments,
        // it is unnecessary to have to manually call the modal.
        // $('#addBookDialog').modal('show');
    });
</script>
@include('admin.partials.script-part')
</body>
</html>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('admin.partials.style-part')

    <title>Admin</title>
</head>

<body>
@include('admin.partials.navbar-part')

<div class="container mt-4">
    <section class="text-center">
        <h2>Konfirmasi Pinjaman</h2>
    </section>
        <div class="row mt-3">
            <div class="input-group mb-3">
                <span class="input-group-text">Member name</span>
                <input type="text" aria-label="Name" class="form-control" value="{{$cart->member->name}}" disabled>
            </div>

            @foreach($cart->books as $book)
                <div class="input-group mb-3">
                    <span class="input-group-text">Book Title</span>
                    <input type="text" aria-label="Name" class="form-control" value="{{$book->title}}" disabled>
                </div>
            @endforeach
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Total day</span>
            <input type="text" aria-label="Name" class="form-control" value="{{$cart->total_day ?? 1}}" disabled>
        </div>


        <div class="container d-flex justify-content-center gap-2">
            <div class="mt-5 text-center">
                <form action="/confirm/{{$cart->id}}" method="post">
                    @csrf
                    <input type="hidden" name="status" value="decline">
                    <button type="submit" name="decline" class="btn btn-danger">Decline</button>
                </form>
            </div>
            <div class="mt-5 text-center">
                <form action="/confirm/{{$cart->id}}" method="post">
                    @csrf
                    <input type="hidden" name="status" value="approve">
                    <button type="submit" name="approve" class="btn btn-success">Approve</button>
                </form>
            </div>
            <div class="mt-5 text-center">
                <a href="/"></a>
            </div>
        </div>

</div>

</body>

<script>
</script>

</html>

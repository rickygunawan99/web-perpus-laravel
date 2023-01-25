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
    @include('admin.partials.sidebar-part', ['confirm_borrow' => 'true'])
    <div class="main">
        <nav class="navbar navbar-expand navbar-light navbar-bg">
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav navbar-align">
                    <li class="nav-item dropdown">
                </ul>
            </div>
        </nav>
        <main class="content">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="row">
                        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                            <div class="container mt-4">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>


@include('admin.partials.script-part')
</html>

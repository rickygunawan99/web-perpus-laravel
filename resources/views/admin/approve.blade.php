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
                <h1 class="h3 text-center fw-bold">Daftar Request Pinjaman</h1>
                <div class="row">
                    <div class="row">
                        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
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
                                        @foreach($transaction as $row)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <td>{{$row->total_day ?? '1'}} day</td>
                                                <td>
                                                    <a href="{{route('admin.confirm', ['cart'=>$row->id])}}" class="btn btn-success btn-sm"><i class="bi bi-pen"> Confirm</i></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </section>
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

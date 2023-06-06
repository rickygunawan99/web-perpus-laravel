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

    <title>Tambah Buku</title>

    <link href="/assets/css/app.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap"
        rel="stylesheet"
    />

    <title>Admin</title>
</head>

<body>
<div class="wrapper">
    @include('admin.partials.sidebar-part', ['add_member' => 'true'])

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
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-md-8 col-lg-6 col-xl-6 offset-xl-1">
                            <div class="card p-3">
                                <h4>Daftarkan member baru</h4>
                                <div class="card-body">
                                    <form method="post" action="{{route('admin.do-add-member')}}">
                                        <!-- Email input -->
                                        <div class="form-outline mb-4">
                                            <input type="email" id="form3Example3" class="form-control form-control-lg"
                                                   placeholder="Email" name="email" autocomplete="off"/>
                                            <label class="form-label" for="form3Example3">email</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="form3Example3" class="form-control form-control-lg"
                                                   placeholder="Nama" name="name" autocomplete="off"/>
                                            <label class="form-label" for="form3Example3">Nama</label>
                                        </div>

                                        <!-- Password input -->
                                        <div class="form-outline mb-3">
                                            <input type="password" id="form3Example4" class="form-control form-control-lg"
                                                   placeholder="Enter password" name="password" />
                                            <label class="form-label" for="form3Example4">Password</label>
                                        </div>

                                        <div class="text-center text-lg-start mt-4 pt-2">
                                            <button type="submit" class="btn btn-primary btn-lg"
                                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Daftar</button>
                                        </div>
                                        @csrf
                                    </form>
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

<!DOCTYPE html>
<html lang="en">

<head>
    @include('/partials/style')

    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
        .h-custom {
            height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
    <title>Katalog Buku</title>
</head>
<body>
@include('/partials/navbar')
<section class="vh-100">
    <div class="container h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-8 col-lg-6 col-xl-6 offset-xl-1">
                <div class="card">
                    <h4>Reset password anda</h4>
                    <div class="card-body">
                        <form method="post" action="{{route('confirm-reset.store')}}">

                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example3">Password Baru</label>
                                <input type="text" id="form3Example3" class="form-control form-control-lg"
                                       placeholder="Password Baru" name="new" autocomplete="off"
                                       value="{{old('new') ?? ''}}"/>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="form3Example3">Ketik ulang Password Baru</label>
                                <input type="text" id="form3Example3" class="form-control form-control-lg @error('confirm_new') is-invalid @enderror"
                                       placeholder="Password Baru" name="confirm_new" autocomplete="off"/>
                            </div>
                            @error('confirm_new')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                            <div class="text-center text-lg-start mt-4 pt-2">
                                <button type="submit" class="btn btn-primary btn-lg"
                                        style="padding-left: 2.5rem; padding-right: 2.5rem;">Reset</button>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Right -->
        <div>
            <a href="#" class="text-white me-4">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="text-white me-4">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-white me-4">
                <i class="fab fa-google"></i>
            </a>
            <a href="#" class="text-white">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </div>
        <!-- Right -->
    </div>
</section>
</body>
@include('partials.script')
@include('partials.footer')
</html>

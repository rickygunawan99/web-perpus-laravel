<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/admin">ADMIN</a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto gap-2">
                <a class="nav-link border-2 rounded-pill bg-light" href="{{route('admin.approve')}}">Konfirmasi Pinjaman</a>
                <a class="nav-link border-2 rounded-pill bg-light" href="{{route('admin.carts')}}">Konfirmasi Pengembalian</a>
                <a class="nav-link border-2 rounded-pill bg-light" href="{{route('admin.add-book')}}">+ Tambah buku</a>
                <form action="{{route('admin.logout')}}" method="POST">
                    @csrf
                    <button name="logout" class="btn text-light border-2 bg-danger" type="submit">Keluar <i class="bi bi-box-arrow-right ps-1"></i></button>
                </form>
            </div>
        </div>
    </div>
</nav>


<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Perpustakaan apa</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Pages</li>


            <li class="sidebar-item @isset($dashboard) active @endisset">
{{--            <li @class(['sidebar-item', 'active' => $dashboard]) >--}}
                <a class="sidebar-link" href="/admin">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item @isset($all_book) active @endisset">
                <a class="sidebar-link" href="/admin/books">
                    <i class="align-middle" data-feather="book-open"></i>
                    <span class="align-middle">Daftar buku</span>
                </a>
            </li>

            <li class="sidebar-item @isset($add_book) active @endisset">
                <a class="sidebar-link" href="{{route('admin.add-book')}}">
                    <i class="align-middle" data-feather="plus-circle"></i>
                    <span class="align-middle">Tambah buku</span>
                </a>
            </li>

            <li class="sidebar-item @isset($add_member) active @endisset">
                <a class="sidebar-link" href="{{route('admin.add-member')}}">
                    <i class="align-middle" data-feather="user-plus"></i>
                    <span class="align-middle">Daftarkan member</span>
                </a>
            </li>

            <li class="sidebar-item  @isset($confirm_borrow) active @endisset">
                <a class="sidebar-link" href="{{route('admin.approve')}}">
                    <i class="align-middle" data-feather="check-circle"></i>
                    <span class="align-middle">Konfirmasi pinjaman</span>
                </a>
            </li>

            <li class="sidebar-item  @isset($confirm_return) active @endisset">
                <a class="sidebar-link" href="{{route('admin.carts')}}">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Konfirmasi pengembalian</span>
                </a>
            </li>

            <li class="sidebar-item  @isset($chart) active @endisset">
                <a class="sidebar-link" href="{{route('admin.logout')}}">
                    <i class="align-middle" data-feather="log-out"></i>
                    <span class="align-middle">Logout</span>
                </a>
            </li>

        </ul>
    </div>
</nav>

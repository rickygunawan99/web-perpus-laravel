
<style>
    .badge {
        padding-left: 9px;
        padding-right: 9px;
        -webkit-border-radius: 9px;
        -moz-border-radius: 9px;
        border-radius: 9px;
    }

    #search:focus-within {
        border-color: #80bdff;
        box-shadow: none;
    }

    #login:hover{
        color: blue;
        background: white;
    }
</style>

<div class="head-nav">
    <div class="">
        <ul>
            <li class="nav-head-link"><a href="default.asp">Home</a></li>
            <li class="nav-head-link"><a href="news.asp">News</a></li>
            <li class="nav-head-link"><a href="contact.asp">Contact</a></li>
            <li class="nav-head-link"><a href="about.asp">About</a></li>
        </ul>
    </div>
</div>
<nav class="main-nav">
    <input type="checkbox" id="check" />
    <label for="check" class="menu">
        <h2><i class="bi bi-list"></i></h2>
    </label>
    <div class="logo">
        <a href="/"><h2>Perpustakaan</h2></a>
    </div>
    <div class="nav-items">
        <ul class="overview">
            <form action="" method="get">
                <div class="wrap-nav" style="width: 40%">
                    <div class="input-group flex-nowrap">
                        <input type="text" class="form-control" name="s" id="search" placeholder="Cari apa?" autocomplete="off" aria-label="search" aria-describedby="addon-wrapping">
                        <button type="button" class="input-group-text" id="addon-wrapping">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </ul>
        <ul class="account">
            <!-- <li>
                <button type="button" class="btn-cart-nav"><i class="bi bi-basket3-fill"></i></button>
            </li> -->
            <li>
                <button class="btn btn-md mt-3">
                    <a href="{{route('cart.detail')}}">
                        <i class="bi bi-cart-fill fs-3"></i>
                    </a>
                </button>
            </li>
            @if(Session::has('id'))
                <li>
                    <form action="{{route('member.logout', ['id'=>Session::get('id')])}}" method="post">
                        @csrf
                        <button type="submit" class="button-nav btn-danger btn-login-nav mt-4" id="logout">Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{route('member.login')}}" type="button" class="button-nav btn-login-nav mt-4" id="login">Login</a>
                </li>
            @endif
        </ul>
    </div>
</nav>

<div class="container d-flex justify-content-center">
    @if(session('success'))
        <div class="alert alert-success mx-auto w-50" role="alert">
            {{session('success')}}
        </div>
    @endif
    @if(session('err'))
        <div class="alert alert-danger d-flex justify-content-center w-50" role="alert">
            {{session('err')}}
        </div>
    @endif
</div>

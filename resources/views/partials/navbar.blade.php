
<style>
    .badge {
        padding-left: 9px;
        padding-right: 9px;
        -webkit-border-radius: 9px;
        -moz-border-radius: 9px;
        border-radius: 9px;
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
            <div class="wrap-nav">
                <div class="search-nav">
                    <input type="text" class="searchForm-nav" placeholder="Cari Apa ?">
                    <button type="submit" class="searchButton-nav">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </ul>
        <ul class="account">
            <li>
                <i class="fa" style="font-size:24px">&#xf07a;</i>
                <span class='badge badge-warning' id='lblCartCount'> 5 </span>
            </li>
            <!-- <li>
                <button type="button" class="btn-cart-nav"><i class="bi bi-basket3-fill"></i></button>
            </li> -->
            <li>
                <div class="vl"></div>
            </li>
            @if(Session::has('id'))
                <li>
                    <form action="{{route('member.logout', ['id'=>Session::get('id')])}}" method="post">
                        @csrf
                        <button type="submit" class="button-nav btn-danger btn-login-nav" id="logout">Logout</button>
                    </form>
                </li>
            @else
                <li>
                    <a href="{{route('member.login')}}" type="button" class="button-nav btn-login-nav" id="login">Login</a>
                </li>
            @endif
        </ul>
    </div>
</nav>

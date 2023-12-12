@php
$containerNav = $containerNav ?? 'container-fluid';
$navbarDetached = ($navbarDetached ?? '');
@endphp

<!-- Navbar -->
@if(isset($navbarDetached) && $navbarDetached == 'navbar-detached')
<nav class="layout-navbar {{$containerNav}} navbar navbar-expand-xl {{$navbarDetached}} align-items-center bg-navbar-theme" id="layout-navbar">
  @endif
  @if(isset($navbarDetached) && $navbarDetached == '')
  <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="{{$containerNav}}">
      @endif

      <!--  Brand demo (display only for navbar-full and hide on below xl) -->
      @if(isset($navbarFull))
      <div class="navbar-brand app-brand demo d-xl-flex py-0 me-4">
        <a href="{{url('/')}}" class="app-brand-link gap-2">
          <span class="app-brand-logo demo">
{{--            @include('_partials.macros',["height"=>20])--}}
          </span>
          <span class="app-brand-text demo menu-text fw-bold">Perpustakaan</span>
        </a>
      </div>
      @endif

      <!-- ! Not required for layout-without-menu -->
{{--      @if(!isset($navbarHideToggle))--}}
{{--      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0{{ isset($menuHorizontal) ? ' d-xl-none ' : '' }} {{ isset($contentNavbar) ?' d-xl-none ' : '' }}">--}}
{{--        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">--}}
{{--          <i class="ti ti-menu-2 ti-sm"></i>--}}
{{--        </a>--}}
{{--      </div>--}}
{{--      @endif--}}

        @auth('member')
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="me-3">
                    <div class="avatar position-relative">
                        <a href="/cart/detail" class="">
                            <img src="{{asset('assets/img/elements/cart.svg')}}" alt="cart" class="w-px-40 h-auto">
                            <span class="badge bg-white p-1 text-primary position-absolute fs-5"
                                  style="top: -5px; right: -15px">3</span>
                        </a>
                    </div>
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="{{asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item"
                               href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                                 class="w-px-40 h-auto rounded-circle">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                          <span class="fw-semibold d-block">
                            @if (Auth::guard('member')->check())
                                  {{ Auth::guard('member')->user()->name }}
                              @else
                                  John Doe
                              @endif
                          </span>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li class="dropdown-item">
                            <a class="nav-link style-switcher-toggle hide-arrow px-0 py-0 text-black"
                               href="javascript:void(0);">
                                <i class='ti ti-sm me-2'></i>
                                <span class="align-middle">Dark Theme</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('history.index')}}">
                                <i class='ti ti-history ti-sm me-2'></i>
                                <span class="align-middle">Riwayat</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item"
                               href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
                                <i class="ti ti-user-check me-2 ti-sm"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>

                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        @if (Auth::guard('member')->check())
                            <li>
                                <a class="dropdown-item"
                                   href="{{route('member.logout', ['id' => Auth::guard('member')->user()->id])}}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class='ti ti-logout me-2'></i>
                                    <span class="align-middle">Logout</span>
                                </a>
                            </li>
                            <form method="POST" id="logout-form"
                                  action="{{route('member.logout', ['id' => Auth::guard('member')->user()->id])}}">
                                @csrf
                            </form>
                        @else
                            <li>
                                <a class="dropdown-item" href="{{route('member.logout', ['id' => Auth::id()])}}">
                                    <i class='ti ti-login me-2 text-danger'></i>
                                    <span class="align-middle">Logout</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
        @endauth

        @auth('admin')
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="{{asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item"
                                   href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar avatar-online">
                                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                                     class="w-px-40 h-auto rounded-circle">
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                          <span class="fw-semibold d-block">
                                            @if (Auth::guard('admin')->check())
                                                  {{ Auth::guard('admin')->user()->name }}
                                              @else
                                                  John Doe
                                              @endif
                                          </span>
                                            <small class="text-muted">Admin</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link style-switcher-toggle hide-arrow px-0 py-0 text-black"
                                   href="javascript:void(0);">
                                    <i class='ti ti-sm me-2'></i>
                                    <span class="align-middle">Dark Theme</span>
                                </a>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                   href="{{ Route::has('profile.show') ? route('profile.show') : 'javascript:void(0);' }}">
                                    <i class="ti ti-user-check me-2 ti-sm"></i>
                                    <span class="align-middle">My Profile</span>
                                </a>
                            </li>

                            <li>
                                <div class="dropdown-divider"></div>
                            </li>
                            @if (Auth::guard('admin')->check())
                                <li>
                                    <a class="dropdown-item"
                                       href=""
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class='ti ti-logout me-2'></i>
                                        <span class="align-middle">Logout</span>
                                    </a>
                                </li>
                                <form method="POST" id="logout-form"
                                      action="">
                                    @csrf
                                </form>
                            @endif
                        </ul>
                    </li>
                    <!--/ User -->
                </ul>
            </div>
        @endauth


        @if(!Auth::guard('member')->hasUser() and !Auth::guard('admin')->hasUser())
            <a class="btn btn-success" href="/login">Login</a>
        @endif

      @if(!isset($navbarDetached))
    </div>
    @endif
  </nav>
  <!-- / Navbar -->
</nav>

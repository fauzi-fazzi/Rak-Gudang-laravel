<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <a href="#" class="navbar-brand sidebar-gone-hide">Warehouse Aster</a>
    <div class="navbar-nav">
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>
    <form action="{{ route('search') }}" class="form-inline ml-auto">
        <ul class="navbar-nav">
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
        <div class="search-element">
            <input name="search" value="{{ request('search') }}" class="form-control" type="search"
                placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>

        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                @if (Auth::user())
                    <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @if (Auth::user())
                    <div class="dropdown-title">{{ Auth::user()->email }}</div>
                    <a href="features-profile.html" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <a href="features-settings.html" class="dropdown-item has-icon">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                @endif
                <div class="dropdown-divider"></div>
                @if (Auth::user())
                    <a href="#" class="dropdown-item has-icon text-danger"
                        data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                        data-confirm-yes="document.getElementById('logout-form').submit()">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                @else
                    <a href="{{ route('login') }}" class="dropdown-item has-icon text-primary">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                @endif

            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>

<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            @if (Auth::user())
                <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
                    <a href="{{ url('home') }}" class="nav-link "><i
                            class="fas fa-home"></i><span>Dashboard</span></a>
                </li>
            @endif
            <li
                class="nav-item {{ request()->is('rak/*') ? 'active' : '' }} {{ request()->is('rak') ? 'active' : '' }}">
                <a href="{{ url('rak') }}" class="nav-link"><i class="fas fa-layer-group"></i><span>Rak</span></a>
            </li>
            @if (Auth::user())
                <li class="nav-item {{ request()->is('master/*') ? 'active' : '' }} dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link has-dropdown" aria-expanded="false"><i
                            class="fas fa-table"></i><span>Data Master</span></a>
                    <ul class="dropdown-menu" style="display: none;">
                        <li
                            class="nav-item {{ request()->is('rak/*') ? 'active' : '' }} {{ request()->is('master/rak') ? 'active' : '' }}">
                            <a href="{{ route('master.rak') }}" class="nav-link">Data Rak</a>
                        </li>
                        <li
                            class="nav-item {{ request()->is('vendor/*') ? 'active' : '' }} {{ request()->is('master/vendor') ? 'active' : '' }}">
                            <a href="{{ route('master.vendor') }}" class="nav-link">Data Vendor</a>
                        </li>
                        <li
                            class="nav-item {{ request()->is('kategori/*') ? 'active' : '' }} {{ request()->is('master/kategori') ? 'active' : '' }}">
                            <a href="{{ route('master.kategori') }}" class="nav-link">Data Kategori</a>
                        </li>
                        <li
                            class="nav-item {{ request()->is('satuan/*') ? 'active' : '' }} {{ request()->is('master/satuan') ? 'active' : '' }}">
                            <a href="{{ route('master.satuan') }}" class="nav-link">Data Satuan</a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</nav>

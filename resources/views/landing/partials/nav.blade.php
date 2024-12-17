<!-- Sidebar Start -->
<nav class="site-nav" style="background: #6998AB;">
    <div class="container">
        <div class="site-navigation">
            <a href="index.html" class="logo m-0">AKSARA FOODS COURT <span class="text-primary">.</span></a>

            <ul class="js-clone-nav d-none d-lg-inline-block text-left site-menu float-right">
                
                @if(Auth::guard('penyewa')->check())
                <li class="active"><a href="{{ route('dashboard') }}">Home</a></li>
                <li><a href="{{ route('chart') }}">Keranjang</a></li>
                <li><a href="{{ route('riwayat.tagihan') }}">Riwayat</a></li>
                
                <li class="nav-item px-auto">
                    <form action="{{ route('penyewa.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="nav-link text-white"
                            style="border: none; background: none; padding: 0;">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>
                            LOGOUT Dari {{ Auth::guard('penyewa')->user()->username }}
                        </button>
                    </form>
                </li>
                @else
                <li class="active"><a href="/">Home</a></li>
                <li>
                    <a href="{{ route('login') }}">
                        Login
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.login') }}">
                        Login Admin
                    </a>
                </li>
                @endauth
            </ul>

            <a href="#"
                class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light"
                data-toggle="collapse" data-target="#main-navbar">
                <span></span>
            </a>
        </div>

    </div>
</nav>
<!--  Sidebar End -->
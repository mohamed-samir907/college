@if(auth()->guard('admin')->check())
<nav class="navbar navbar-default fixed-top be-top-header">
    <div class="container-fluid">
        <div class="be-navbar-header">
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/admin/home') }}">
                <img src="{{ url('imgs/logo.png') }}" alt="PinOffer" style="max-height: 55px">
                <span style="color: #404040; font-weight:bold">PinOffer</span>
            </a>
            <a class="be-toggle-left-sidebar" href="#"><span class="icon mdi mdi-menu"></span></a>
        </div>
        <div class="be-right-navbar">
            <ul class="nav navbar-nav float-right be-user-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                        <img src="{{ asset('imgs/tomato.svg') }}" alt="{{ auth()->guard('admin')->user()->name }}">
                        <span class="user-name">{{ auth()->guard('admin')->user()->name }}</span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <div class="user-info">
                            <div class="user-name">{{ auth()->guard('admin')->user()->name }}</div>
                            <div class="user-position online">Available</div>
                        </div>
                        <a class="dropdown-item" href="pages-admins.html"><span class="icon mdi mdi-face"></span>Admins</a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit()">
                            <span class="icon mdi mdi-power"></span>Logout
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="post">
                                @csrf
                            </form>
                        </a>
                    </div>
                </li>
            </ul>
            <div class="page-title"><span>@{{ $store.state.headerTitle }}</span></div>
        </div>
    </div>
</nav>
@endif

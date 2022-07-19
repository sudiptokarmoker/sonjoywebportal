<!-- LOGO -->
<div class="topbar-left">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <span><img src="{{ asset('backend/assets_v2/images/logo.png') }}" class="logo-name img-fluid"></span>
    </a>
</div>

<nav class="navbar navbar-custom ">
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <button class="button-menu-mobile open-left waves-light waves-effect">
                <img src="{{ asset('backend/assets_v2/images/icon/toggle.png') }}" class="top-toggle img-fluid">
            </button>
        </li>
    </ul>
    <!--left side-->
            <!-- show admin balance info -->
            <div style="float: left">
                {{-- <x-backend.admin-balance /> --}}
            </div>
        <!-- end of showing vendor balance info -->
    <ul class="nav navbar-nav pull-right">
        <li class="nav-item dropdown">
            @auth
            <a class="nav-link  nav-user" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                @if(isset($profileImage) && file_exists('storage/images/profile_image/thumb/'.$profileImage))
                <img src="{{ asset('storage/images/profile_image/thumb/'.$profileImage) }}" alt="" title="{{ auth()->user()->firstname }}" width="60" />
                @else
                <img src="{{ asset('backend/assets_v2/images/users/avatar-1.jpg') }}" alt="user" class="top-avatar img-circle">
                @endif
                <span class="name-avatar">{{ Auth::user()->full_name }}<i class="icofont-thin-down"></i></span>
            </a>
            <div class="dropdown-menu">
                <a href="{{ route('admin.home.account.settings') }}" class="dropdown-item notify-item">
                    <i class="zmdi zmdi-power"></i> <span>User Settings</span>
                </a>
                 <a href="{{ route('admin.logout') }}" class="dropdown-item notify-item">
                    <i class="zmdi zmdi-power"></i> <span class="text-danger">Logout</span>
                </a>
            </div>
            @endauth
        </li>
    </ul>

</nav>

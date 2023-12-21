<li  class="nav-item dropdown">
    <a class="nav-link" href="{{route('home')}}"><i class='fa fa-home'></i>Dashboard</a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link" href="{{ Route('admin.users.index') }}">
        <i class="fa-solid fa-user"></i>Users
    </a>
</li>
<li class="nav-item dropdown">
    <a class="nav-link" href="{{ Route('admin.logout') }}" title="Log Out">
        <i class="fa fa-key"></i>License Key
    </a>
</li>

<li class="nav-item log_out">
    <a class="nav-link" href="{{ Route('admin.logout') }}" title="Log Out">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>Log Out
    </a>
</li>

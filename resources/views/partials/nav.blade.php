<?php $user = App\Models\JwtSession::user() ?>
<nav class="bottom-navbar">
    <div class="container">
        <ul class="nav page-navigation" style="justify-content:inherit">
            <li class="nav-item">
                <a class="nav-link" href="{{url()->to('/')}}">
                <i class="ti-home menu-icon"></i>
                <span class="menu-title">Home</span>
                </a>
            </li>
            @if($user)
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                <i class="ti-bell menu-icon"></i>
                <span class="menu-title">Pengaduan</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item"><a class="nav-link" href="{{route(strtolower($user->role->name).'.pengaduan.index',['filter'=>'Baru'])}}">Baru</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route(strtolower($user->role->name).'.pengaduan.index',['filter'=>'Di Proses'])}}">Di Proses</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route(strtolower($user->role->name).'.pengaduan.index',['filter'=>'Selesai'])}}">Selesai</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route(strtolower($user->role->name).'.pengaduan.index',['filter'=>'Di Arsipkan'])}}">Di Arsipkan</a></li>
                    </ul>
                </div>
            </li>
            @if($user->role->role_id==1)
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.pengguna.index')}}">
                <i class="ti-user menu-icon"></i>
                <span class="menu-title">Daftar Pengguna</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)">
                <i class="ti-settings menu-icon"></i>
                <span class="menu-title">Pengaturan</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="submenu">
                    <ul class="submenu-item">
                        <li class="nav-item"><a class="nav-link" href="{{route('admin.notif.index')}}">Notifikasi</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{route('admin.faq.index')}}">FAQ</a></li>
                    </ul>
                </div>
            </li>
            @endif
            @endif
        </ul>
    </div>
</nav>
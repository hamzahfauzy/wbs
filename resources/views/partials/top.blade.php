<?php $user = App\Models\JwtSession::user() ?>
<nav class="navbar top-navbar col-lg-12 col-12 p-0">
    <div class="container">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo text-white font-weight-bold" href="{{url()->to('/')}}"><img src="{{asset('images/logo.png')}}" style="height:58px!important;"> Whistle Blowing System</a>
            <a class="navbar-brand brand-logo-mini text-white font-weight-bold" href="{{url()->to('/')}}"><img src="{{asset('images/logo.png')}}" style="height:58px!important;"> WBS</a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
            <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                <h3 class="ti-user"></h3>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="javascript:;" style="background: #eaeaea;border-top: 5px solid #558B2F; cursor: default">
                <i class="ti-user text-primary" style="color: #fff; font-weight: 700"></i>
                <h4>{{$user?$user->nama:'Pengunjung'}}<br>
                <small>{{$user?$user->nama_opd:'Pengunjung'}}</small>
                </h4>
                </a>
                @if($user)
                <a class="dropdown-item">
                <i class="ti-shift-left text-primary"></i>
                Kembali ke Portal Lainnya
                </a>
                <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
                </a>
                @endif
            </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
            <span class="ti-menu"></span>
        </button>
        </div>
    </div>
</nav>
@extends('app')

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="/" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">Website</span>
                    <span class="logo-subtitle">Data Pariwisata</span>
                </div>
            </a>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a class="active" href="/"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
            </ul>
            <span class="system-menu__title">system</span>
            <ul class="sidebar-body-menu">
                <li>
                    <a href="appearance.html"><span class="icon edit" aria-hidden="true"></span>Tambah Pengunjung</a>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon category" aria-hidden="true"></span>Statistik Pengunjung
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="sidebar-footer">
        <a href="##" class="sidebar-user">
            <span class="sidebar-user-img">
                <picture><source srcset="{{ asset('/img/avatar/avatar-illustrated-01.webp')}}" type="image/webp"><img src="{{ asset('assets/img/avatar/avatar-illustrated-01.png')}}" alt="User name"></picture>
            </span>
            <div class="sidebar-user-info">
                <span class="sidebar-user__title">Nafisa Sh.</span>
                <span class="sidebar-user__subtitle">Employee</span>
            </div>
        </a>
    </div>
</aside>
@endsection
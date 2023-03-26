<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-toolbox"></i>
        </div>
       <a href="{{ route('dashboard') }}"><div class="text-center mb-3" style="color: white">{{ Auth::user()->roles->pluck('name')[0] }}</div></a>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @switch(Auth::user()->roles->pluck('name')[0])
        @case('admin')
            <li class="nav-item {{ Request::is('poli*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('poli.index') }}">
                    <i class="fas fa-fw fa-vote-yea"></i>
                    <span>poli</span></a>
            </li>
            <li class="nav-item {{ Request::is('dokter*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dokter.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>dokter</span></a>
            </li>
            <li class="nav-item {{ Request::is('admin*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>petugas</span></a>
            </li>
            <li class="nav-item {{ Request::is('kasir*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kasir.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>kasir</span></a>
            </li>
            <li class="nav-item {{ Request::is('apoteker*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('apoteker.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>apoteker</span></a>
            </li>
            <li class="nav-item {{ Request::is('obat*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('obat.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>obat</span></a>
            </li>
            <li class="nav-item {{ Request::is('pendaftaran*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pendaftaran.all') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>pendaftaran</span></a>
            </li>
            <li class="nav-item {{ Request::is('jenis*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('jenis.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>Jenis Obat</span></a>
            </li>
            <li class="nav-item {{ Request::is('kategori*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kategori.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>Kategori Obat</span></a>
            </li>
            @break
        @case('dokter')
            <li class="nav-item {{ Request::is('pendaftaran*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pendaftaran.all') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>pendaftaran</span></a>
            </li>
            @break
        @case('apoteker')
            <li class="nav-item {{ Request::is('resep*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('resep.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>resep</span></a>
            </li>
            <li class="nav-item {{ Request::is('obat*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('obat.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>obat</span></a>
            </li>
            <li class="nav-item {{ Request::is('jenis*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('jenis.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>Jenis Obat</span></a>
            </li>
            <li class="nav-item {{ Request::is('kategori*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kategori.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>Kategori Obat</span></a>
            </li>
            <li class="nav-item {{ Request::is('penjualan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('penjualan.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>Penjualan Obat</span></a>
            </li>
            @break
        @case('kasir')
            <li class="nav-item {{ Request::is('penjualan*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('penjualan.index') }}">
                    <i class="fas fa-fw fa-people-arrows"></i>
                    <span>Penjualan Obat</span></a>
            </li>
            @break
        @default

    @endswitch

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>

<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="/" class="nav-link">
                <i class="nav-icon fa-solid fa-circle-info"></i>
                <p>Information Board</p>
            </a>
        </li>
        <li class="nav-item {{ request()->is('cari-dokumen') ? 'active' : '' }}">
            <a href="/cari-dokumen" class="nav-link">
                <i class="nav-icon fas fa-search"></i>
                <p>Cari Dokumen TA</p>
            </a>
        </li>
        @if (in_array('koordinator', session('user')['user']->role_dosen))
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-folder"></i>
                <p>
                    Manage Berkas
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Seminar
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/lihat-berkas/seminar-1" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Seminar 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/lihat-berkas/seminar-2" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Seminar 2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/lihat-berkas/seminar-3" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Seminar 3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/lihat-berkas/sidang" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sidang</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if(session('user')['user']->role == 'kota')
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-folder"></i>
                <p>
                    Manage Berkas
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Seminar
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/pemberkasan-kota/seminar-1" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Seminar 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pemberkasan-kota/seminar-2" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Seminar 2</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pemberkasan-kota/seminar-3" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Seminar 3</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/pemberkasan-kota/sidang" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sidang</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @if(in_array('koordinator', session('user')['user']->role_dosen))
        <!-- bimbingan koor -->
        <li class="nav-item {{ request()->is('/manage-bimbingan-pembimbing') ? 'active' : '' }}">
            <a href="/lihat-bimbingan" class="nav-link">
                <i class="nav-icon fas fa-pencil"></i>
                <p>Lihat Bimbingan</p>
            </a>
        </li>
        @endif
        @if(in_array('pembimbing', session('user')['user']->role_dosen))
        <!-- bimbingan pembimbing -->
        <li class="nav-item {{ request()->is('/manage-bimbingan-pembimbing') ? 'active' : '' }}">
            <a href="/manage-bimbingan" class="nav-link">
                <i class="nav-icon fas fa-pencil"></i>
                <p>Manage Bimbingan</p>
            </a>
        </li>
        @endif
        @if (session('user')['user']->role == 'kota')
        <!-- Bimbingan (KoTA) -->
        <li class="nav-item {{ request()->is('/manage-bimbingan-kota') ? 'active' : '' }}">
            <a href="/bimbingan" class="nav-link">
                <i class="nav-icon fas fa-pencil"></i>
                <p>Bimbingan</p>
            </a>
        </li>
        @endif
        @if (in_array('koordinator', session('user')['user']->role_dosen))
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa-solid fa-users"></i>
                <p>
                    Manage Data User
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/manage-akun" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manage Akun</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kota.index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manage KoTA</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/manage-data-dosen" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manage Data Dosen</p>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa-solid fa-gear"></i>
                <p>
                    Pengaturan Akun
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/ubah-password" class="nav-link">
                        <i class="nav-icon fa-solid fa-key"></i>
                        <p>Ubah Password</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>

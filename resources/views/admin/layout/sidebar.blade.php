<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box mt-5 mb-5
    ">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                {{-- <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22"> --}}
            </span>
            <span class="logo-lg">
                {{-- <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17"> --}}
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                {{-- <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22"> --}}
            </span>
            <span class="logo-lg">
                {{-- <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17"> --}}
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                @if (in_array(auth()->user()->role, [0, 1]))
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('list-product') || Request::is('list-rasa') || Request::is('list-pemesanan') ? 'active' : '' }} menu-link"
                            href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="sidebarApps">
                            <i class="ri-apps-2-line"></i>
                            <span data-key="t-apps">List</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarApps">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('Admin.list-product.index') }}"
                                        class="nav-link {{ Request::is('list-product') ? 'active' : '' }}">
                                        <i class="ri-apps-2-line"></i>
                                        List Product</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('Admin.list-rasa') }}"
                                        class="nav-link {{ Request::is('list-rasa') ? 'active' : '' }}">
                                        <i class="ri-apps-2-line"></i>
                                        List Rasa</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('list-pemesanan') ? 'active' : '' }}"
                            href="{{ route('Admin.list-pemesanan.index') }}">
                            <i class="ri-file-list-3-line"></i> <span data-key="t-forms">List Pemesanan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('tukar') ? 'active' : '' }}"
                            href="{{ route('Admin.tukarQr') }}">
                            <i class="ri-qr-code-fill"></i> <span data-key="t-forms">Tukar Qr Code</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role === 0)
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('user') ? 'active' : '' }}"
                            href="{{ route('Admin.crudUser') }}">
                            <i class="ri-group-line"></i> <span data-key="t-forms">User</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('qr') ? 'active' : '' }}"
                            href="{{ route('Admin.createQr') }}">
                            <i class=" ri-qr-scan-line"></i> <span data-key="t-forms">Create Qr Code</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        </li>
        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>

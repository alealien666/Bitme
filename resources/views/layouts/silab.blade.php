<html lang="en" data-layout="horizontal" data-layout-style="" data-layout-position="fixed" data-topbar="light"
    data-layout-mode="light">

<head>

    <title>{{ $title }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <link href="{{ asset('assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
    {{-- icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    {{-- sweetalert --}}
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets1/script.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">
    {{-- flatpickr --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="/home" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('img/logo.png') }}" alt="" height="17">
                                </span>
                            </a>

                            <a href="/home" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    {{-- <img src="{{ asset('') }}" alt="" height="17"> --}}
                                </span>
                            </a>
                        </div>

                        <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <!-- App Search-->
                        @yield('search')
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="dropdown d-md-none topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="bx bx-search fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown" style="">
                                @yield('responsive-search')
                            </div>
                        </div>
                        <div class="dropdown ms-1 topbar-head-dropdown header-item">
                            @yield('kategori')
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>

                        <div class="ms-1 header-item ">
                            <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>

                        @guest
                            <a class="nav-link menu-link" href="/login" aria-controls="sidebarDashboards">
                                <i class="bi bi-box-arrow-in-right"></i> <span data-key="t-dashboards">Login</span>
                            </a>
                        @else
                            <div class="dropdown ms-sm-3 header-item topbar-user pe-4">
                                <button type="button" class="btn" id="page-header-user-dropdown"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="d-flex align-items-center">
                                        <img class="rounded-circle header-profile-user"
                                            src="{{ auth()->user()->avatar == null ? url(asset('img/avatar/no-pic.png')) : (filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : url(asset(auth()->user()->avatar))) }}"
                                            alt="pp">
                                        <span class="text-start ms-xl-2">
                                            <span
                                                class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ auth()->user()->name }}</span>
                                        </span>
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <h6 class="dropdown-header">Welcome {{ auth()->user()->name }}</h6>
                                    <a class="dropdown-item" href="/user"><i
                                            class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                            class="align-middle">Profile</span></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="pages-profile-settings.html"><span
                                            class="badge bg-soft-success text-success mt-1 float-end">New</span><i
                                            class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                                            class="align-middle">Settings</span></a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" method="get"><i
                                            class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                            class="align-middle" data-key="t-logout"
                                            onclick="return confirm('apakah anda yakin ingin keluar..?')">Logout</span></a>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <div id="scrollbar">
                <div class="container">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav m-auto" id="navbar-nav" style="width: 500px;">
                        <li class="nav-item margin">
                            <a class="nav-link menu-link {{ $title === 'Silab | Home' ? 'active' : '' }}"
                                id="link" href="/home"> Home </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#about" id="link">
                                About
                            </a>
                        </li>
                        <li class="nav-item margin">
                            <a class="nav-link menu-link" href="#galleryProduct" id="link">
                                Product
                            </a>
                        </li>
                        <li class="nav-item margin">
                            <a class="nav-link menu-link" href="#contact" id="link">
                                Contact
                            </a>
                        </li>
                        @auth
                            <li class="nav-item margin">
                                <a class="nav-link menu-link {{ $title === 'Silab | Sewa Lab' ? 'active' : '' }}"
                                    href="/lab">
                                    Sewa Lab
                                </a>
                            </li>
                            <li class="nav-item margin">
                                <a class="nav-link menu-link {{ $title === 'Silab | Sewa Jasa Analis' ? 'active' : '' }}"
                                    href="/analisis">
                                    Analisis
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        @if ($errors->any())
            <script>
                callAlert('error', 'gagal', '{{ $errors->all()[0] }}');
            </script>
        @elseif (session('success'))
            <script>
                callAlert('success', 'berhasil', "{{ session('success') }}");
            </script>
        @endif

        <div class="container">
            @yield('konten')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!-- JAVASCRIPT -->
    {{-- <script src="{{ asset('js/main.js') }}"></script> --}}
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('assets/js/plugins.js') }}"></script>

    <script src="{{ asset('assets/js/pages/pricing.init.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>

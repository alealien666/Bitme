@extends('user.layouts.nav')
@section('konten')
    <div class="page-content">
        <div class="container">
            <div class="profile-foreground position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg">
                    <img src="assets/images/profile-bg.jpg" alt="" class="profile-wid-img" />
                </div>
            </div>
            <div class="pt-4 mb-4 mb-lg-3 pb-lg-4">
                <div class="row g-4">
                    <div class="col-auto">
                        <div class="avatar-xl">
                            <img class="rounded-circle img-thumbnail"
                                src="{{ auth()->user()->avatar == null ? url(asset('img/avatar/no-pic.png')) : (filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : url(asset(auth()->user()->avatar))) }}"
                                alt="pp">
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col">
                        <div class="p-2">
                            <h3 class="text-white mb-1">{{ auth()->user()->name }}</h3>
                        </div>
                        <div class="riwayat">
                            <a class="btn btn-success" href="/user/riwayat-pemesanan" aria-controls="sidebarDashboards">
                                <i class="bi bi-list-check"></i></i> <span data-key="t-dashboards">riwayat
                                    pemesanan</span>
                            </a>
                        </div>
                    </div>
                    <!--end col-->

                    <!--end col-->

                </div>
                <!--end row-->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <!-- Tab panes -->
                        <div class="tab-content pt-4 text-muted">
                            <div class="tab-pane active" id="overview-tab" role="tabpanel">
                                <div class="row">
                                    <div class="col-xxl-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-3">Info</h5>
                                                <div class="table-responsive">
                                                    <table class="table table-borderless mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Full Name :</th>
                                                                <td class="text-muted">{{ auth()->user()->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Alamat :</th>
                                                                <td class="text-muted">{{ auth()->user()->alamat }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">E-mail :</th>
                                                                <td class="text-muted">{{ auth()->user()->email }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">No Telp :</th>
                                                                <td class="text-muted">{{ auth()->user()->no_telp }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Gender :</th>
                                                                <td class="text-muted">{{ auth()->user()->gender }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th class="ps-0" scope="row">Bergabung Sejak :</th>
                                                                <td class="text-muted">
                                                                    {{ auth()->user()->created_at->diffForHumans() }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->

                                        {{-- <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title mb-4">Portfolio</h5>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <div>
                                                        <a href="javascript:void(0);" class="avatar-xs d-block">
                                                            <span
                                                                class="avatar-title rounded-circle fs-16 bg-dark text-light">
                                                                <i class="ri-github-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="javascript:void(0);" class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                                                <i class="ri-global-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="javascript:void(0);" class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16 bg-success">
                                                                <i class="ri-dribbble-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="javascript:void(0);" class="avatar-xs d-block">
                                                            <span class="avatar-title rounded-circle fs-16 bg-danger">
                                                                <i class="ri-pinterest-fill"></i>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card body --> --}}
                                    </div><!-- end card -->


                                    <!--end row-->

                                    <!--end tab-content-->
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                </div><!-- container-fluid -->
            </div><!-- End Page-content -->

            @include('user.layouts.footer')
        </div><!-- end main content-->
    </div>

    </div>
@endsection

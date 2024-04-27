@extends('user.layouts.nav')
@section('konten')
    <form action="{{ route('user-edit-profile', auth()->user()->id) }}" method="post" enctype="multipart/form-data">
        @csrf
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
                            <div class="avatar-lg">
                                <img class="rounded-circle img-thumbnail"
                                    src="{{ auth()->user()->avatar == null ? url(asset('img/avatar/no-pic.png')) : (filter_var(auth()->user()->avatar, FILTER_VALIDATE_URL) ? auth()->user()->avatar : url(asset(auth()->user()->avatar))) }}"
                                    alt="pp">
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col">
                            <div class="row">
                                <div class="col-md-6">
                                    <div style="width: 300px;">
                                        <label for="pp" class="form-label text-light">Pilih Foto Profile Anda</label>
                                        <input type="file" name="pp" id="pp" class="form-control w-30">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-light fs-5" style="font-weight: 500">{{ auth()->user()->email }}</p>
                                    <p class="text-light fs-5" style="font-weight: 500">
                                        {{ auth()->user()->created_at->diffForHumans() }}</p>
                                </div>
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
                                                    <h5 class="card-title mb-3">Lengkapi Info Anda</h5>
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">Full Name :
                                                                    </th>
                                                                    <td class="text-muted">
                                                                        <input type="text" name="nama" id="nama"
                                                                            class="form-control"
                                                                            value="{{ auth()->user()->name }}"
                                                                            style="width:250px;">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">Alamat :</th>
                                                                    <td class="text-muted"><input type="text"
                                                                            name="alamat" id="alamat"
                                                                            class="form-control"
                                                                            value="{{ auth()->user()->alamat }}"
                                                                            style="width:250px;">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">No-Telp :</th>
                                                                    <td class="text-muted"><input type="number"
                                                                            name="no" id="no"
                                                                            class="form-control"
                                                                            value="{{ auth()->user()->no_telp }}"
                                                                            style="width:250px;">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th class="ps-0" scope="row">gender :</th>
                                                                    <td class="text-muted">
                                                                        <select class="form-select" name="gender"
                                                                            id="gender" style="width: 250px;" required>
                                                                            <option value="" selected>Pilih Gender
                                                                            </option>
                                                                            <option value="laki laki">Laki-laki</option>
                                                                            <option value="perempuan">Perempuan</option>
                                                                            {{-- @php
                                                                                $foundMale = false;
                                                                                $foundFemale = false;
                                                                            @endphp
                                                                            @foreach ($users as $user)
                                                                                @if ($user->gender === 'laki laki' && !$foundMale)
                                                                                    <option value="{{ $user->gender }}"
                                                                                        selected>Laki-laki</option>
                                                                                    @php $foundMale = true; @endphp
                                                                                @elseif ($user->gender === 'perempuan' && !$foundFemale)
                                                                                    <option value="{{ $user->gender }}"
                                                                                        selected>Perempuan</option>
                                                                                    @php $foundFemale = true; @endphp
                                                                                @endif
                                                                            @endforeach --}}
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="m-auto pt-3" style="width:200px;">
                                                        <button class="btn btn-success" type="submit"
                                                            style="width: 200px;">Perbarui
                                                            Profil</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title mb-4">Follow Sosial Media Bitme</h5>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <div>
                                                            <a href="#" class="avatar-xs d-block">
                                                                <span
                                                                    class="avatar-title rounded-circle fs-16 bg-dark text-light">
                                                                    <i class="ri-github-fill"></i>
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a href="#" class="avatar-xs d-block">
                                                                <span class="avatar-title rounded-circle fs-16 bg-primary">
                                                                    <i class=" ri-twitter-line"></i>
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a href="#" class="avatar-xs d-block">
                                                                <span class="avatar-title rounded-circle fs-16 bg-success">
                                                                    <i class=" ri-whatsapp-line"></i>
                                                                </span>
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a href="#" class="avatar-xs d-block">
                                                                <span class="avatar-title rounded-circle fs-16 bg-danger">
                                                                    <i class="ri-instagram-line"></i>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
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
    </form>
@endsection

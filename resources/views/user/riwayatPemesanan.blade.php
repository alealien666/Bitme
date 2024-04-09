@extends('layouts.silab')
@section('search')
    <form class="app-search d-none d-md-block" action="{{ route('analisis') }}" method="get">
        @csrf
        <div class="position-relative d-flex">
            <input type="search" method="GET" name="cari" class="form-control" placeholder="Search..." autocomplete="off"
                id="search-options" value="{{ old('cari') }}">
            <button type="submit" class="btn btn-primary ms-3 ">Cari</button>
            <span class="mdi mdi-magnify search-widget-icon"></span>
            <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                id="search-close-options"></span>
        </div>
    </form>
@endsection
@section('responsive-search')
    <form class="p-3">
        @csrf
        <div class="form-group m-0">
            <div class="input-group">
                <input type="search" action="{{ route('index') }}" name="cari" class="form-control"
                    placeholder="Search ..." aria-label="Recipient's username" value="{{ old('cari') }}">
                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
            </div>
        </div>
    </form>
@endsection
@section('konten')
    <style>
        #listTotal {
            max-height: 100px;
            overflow-y: scroll;
        }

        .list1 {
            display: flex;
            justify-content: space-between;
            list-style: none;
            padding: 0;
        }

        .item1 {
            flex: 1;
            text-align: start;
        }

        .item1:last-child {
            text-align: end;
        }
    </style>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Halaman Riwayat Pemesanan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="/lab">Home</a></li>
                                <li class="breadcrumb-item"><a href="/user">User</a></li>
                                <li class="breadcrumb-item active">Riwayat Pemesanan</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            {{-- tab select --}}
            <div class="row justify-content-center mt-4">
                <div class="col-lg-5">
                    <div class="text-center mb-4">
                        <h4 class="fw-semibold fs-23">Riwayat Pemesanan</h4>
                        <p class="text-muted mb-4 fs-15">
                            pemesanan ruangan dan pemesanan analisis
                        </p>

                        <div class="d-inline-flex">
                            <ul class="nav nav-pills arrow-navtabs nav-success bg-light mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#arrow-overview" role="tab"
                                        id="tab-pending">
                                        <span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
                                        <span class="d-none d-sm-block">Pending</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#arrow-profile" role="tab">
                                        <span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
                                        <span class="d-none d-sm-block">Approved</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- tab content --}}
            <div class="row">
                <div class="tab-content text-muted">
                    {{-- data pending --}}
                    <div class="tab-pane active" id="arrow-overview" role="tabpanel">
                        <div class="row d-flex justify-content-center">
                            @foreach ($listPemesanan as $list)
                                @if ($list->status === 'pending')
                                    <div class="col-md-6">
                                        <div class="card border card-border-warning">
                                            <div class="card-header bg-warning d-flex">
                                                <h6 class="card-title text-light mb-0">{{ $list->jenis_pesanan }} <span
                                                        class="badge bg-light text-dark align-middle fs-10">{{ $list->status }}</span>
                                                </h6>
                                                @if ($list->bukti_pembayaran === null)
                                                    <p class="pe-3 ms-auto text-light"
                                                        id="deadline_{{ $list->id_pemesanan }}"></p><br>
                                                @else
                                                    <i
                                                        class="ri-checkbox-circle-fill fs-15 align-middle ms-auto text-success"></i>
                                                    <p class="text-light pe-3">Paid</p>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <table>
                                                    <tr>
                                                        <td>Tanggal Pemesanan</td>
                                                        <td class="ps-3"> : </td>
                                                        <td class="ps-3"> <b> {{ $list->order }} </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>No pemesanan</td>
                                                        <td class="ps-3"> : </td>
                                                        <td class="ps-3"> <b> {{ $list->id_pemesanan }} </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Pemesan</td>
                                                        <td class="ps-3"> : </td>
                                                        <td class="ps-3"><b> {{ $list->nama_pemesan }} </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>No Telepon</td>
                                                        <td class="ps-3"> : </td>
                                                        <td class="ps-3"><b> {{ $list->no_telp }} </b></td>
                                                    </tr>
                                                </table>
                                                <div class="text-end pt-3">
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#modal{{ $list->id_pemesanan }}">
                                                        <a class="link-warning fw-medium">detail pemesanan
                                                            <i class="ri-arrow-right-line align-middle"></i>
                                                        </a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if ($jumlahPending === 0)
                                <div class="noresult">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                            colors="primary:#405189,secondary:#0ab39c" style="width: 75px; height: 75px">
                                        </lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted">
                                            Tidak ada data pemesanan dengan id pemesanan atau nama pemesanan
                                            tersebut.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- data approved --}}
                    <div class="tab-pane" id="arrow-profile" role="tabpanel">
                        <div class="row  d-flex justify-content-center">
                            @foreach ($listPemesanan as $list)
                                @if ($list->status === 'approved')
                                    <div class="col-md-6">
                                        <div class="card border card-border-success">
                                            <div class="card-header bg-success">
                                                <h6 class="card-title text-light mb-0">
                                                    {{ $list->jenis_pesanan }} <span
                                                        class="badge align-middle fs-10">{{ $list->status }}</span>
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <table>
                                                    <tr>
                                                        <td>Tanggal Pemesanan</td>
                                                        <td class="ps-3"> : </td>
                                                        <td class="ps-3"> <b> {{ $list->order }} </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>No pemesanan</td>
                                                        <td class="ps-3"> : </td>
                                                        <td class="ps-3"> <b> {{ $list->id_pemesanan }} </b>
                                                            @if ($list->bukti_pembayaran !== null)
                                                                <small class="badge bg-success">(Lunas Pembayaran)</small>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Nama Pemesan</td>
                                                        <td class="ps-3"> : </td>
                                                        <td class="ps-3"><b> {{ $list->nama_pemesan }} </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>No Telepon</td>
                                                        <td class="ps-3"> : </td>
                                                        <td class="ps-3"><b> {{ $list->no_telp }} </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td>pembayaran</td>
                                                        <td class="ps-3"> : </td>
                                                        <td class="ps-3">
                                                            <button class="btn btn-sm btn-soft-success px-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalReview{{ $list->id_pemesanan }}">
                                                                review
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <div class="text-end pt-3">
                                                    <button type="button" class="btn" data-bs-toggle="modal"
                                                        data-bs-target="#modal{{ $list->id_pemesanan }}">
                                                        <a class="link-success fw-medium">detail pemesanan
                                                            <i class="ri-arrow-right-line align-middle"></i>
                                                        </a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            @if ($jumlahApproved === 0)
                                <div class="noresult">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                            colors="primary:#405189,secondary:#0ab39c" style="width: 75px; height: 75px">
                                        </lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted">
                                            Tidak ada data pemesanan dengan id pemesanan atau nama pemesanan
                                            tersebut.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    {{-- modal detail --}}
    @foreach ($listPemesanan as $list)
        <div id="modal{{ $list->id_pemesanan }}" class="modal zoomIn" tabindex="-1" aria-labelledby="myModalLabel"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Detail Pemesanan
                            <small>({{ $list->jenis_pesanan }})</small>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <img class="img-preview col-md-12"
                                        src="{{ asset('img/bukti-pembayaran/' . basename($list->bukti_pembayaran)) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-12">
                                    <table>
                                        <tr>
                                            <td>No pemesanan</td>
                                            <td class="ps-3"> : </td>
                                            <td class="ps-3"> <b> {{ $list->id_pemesanan }} </b>
                                                @if ($list->status === 'approved')
                                                    <small class="badge bg-success">(Lunas Pembayaran)</small>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Pemesanan</td>
                                            <td class="ps-3"> : </td>
                                            <td class="ps-3"> <b> {{ $list->order }} </b></td>
                                        </tr>
                                        <tr>
                                            @if ($list->jenis_pesanan === 'Sewa Lab')
                                                <td>Nama Labs</td>
                                                <td class="ps-3"> : </td>
                                                <td class="ps-3">
                                                    @foreach ($list['labs'] as $key => $labs)
                                                        <b> {{ $labs->nama_lab }} </b>
                                                    @endforeach
                                                </td>
                                            @else
                                                <td>Jenis Analisis</td>
                                                <td class="ps-3"> : </td>
                                                <td class="ps-3">
                                                    @foreach ($list['analis'] as $key => $analis)
                                                        <b> {{ $analis->jenis_pengujian }} </b>
                                                    @endforeach
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td>Nama Pemesan</td>
                                            <td class="ps-3"> : </td>
                                            <td class="ps-3"><b> {{ $list->nama_pemesan }} </b></td>
                                        </tr>
                                        <tr>
                                            <td>No Telepon</td>
                                            <td class="ps-3"> : </td>
                                            <td class="ps-3"><b> {{ $list->no_telp }} </b></td>
                                        </tr>
                                    </table>
                                </div>
                                <hr>
                                @if ($list->jenis_pesanan === 'Sewa Lab')
                                    <div class="col-md-12">
                                        <div class="list-header mb-3">
                                            <b>List Jenis Alat &nbsp;&nbsp;&nbsp; :</b>
                                        </div>
                                        <ul class="list-content mx-0" id="listTotal">
                                            <li class="list-unstyled" id="listItem">
                                                <ul class="list-inline list1" style="margin-left: -30px;">
                                                    <table>
                                                        <tr class="text-center">
                                                            <th>Nama Alat</th>
                                                            <th>Jumlah</th>
                                                            <th>Harga</th>
                                                        </tr>
                                                        @foreach ($list['alat'] as $key => $alat)
                                                            <tr>
                                                                <td style="ps-5 pe-5">{{ $alat->jenis_alat }}</td>
                                                                <td class="text-center">{{ $alat->jumlah_alat }}</td>
                                                                <td class="ps-5 pe-5">
                                                                    Rp.{{ number_format($alat->harga, 0, ',', '.') }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                                <div class="text-end pt-3">
                                    total pembayaran : &nbsp;&nbsp;&nbsp; <b>Rp.
                                        {{ number_format($list->total_biaya, 0, ',', '.') }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($list->bukti_pembayaran === null)
                        <div class="modal-footer" style="display: flex">
                            <form action="{{ route('upload-pembayaran', $list->id_pemesanan) }}" method="post"
                                enctype="multipart/form-data"
                                style="display: flex; justify-content: space-between; width: 100%">
                                @csrf
                                <input type="file" name="bukti" class="form-control" style="width: 300px">
                                <input type="hidden" name="id" value="{{ $list->id_pemesanan }}">
                                <button type="submit" name="submit" class="btn btn-success">unggah bukti
                                    Pembayaran</button>
                            </form>
                        </div>
                    @endif
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    @endforeach
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Silab.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Tefa Polije
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7/dayjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7/plugin/relativeTime.js"></script>
<script>
    @foreach ($listPemesanan as $list)

        const expiredAt_{{ $list->id_pemesanan }} = dayjs("{{ $list->expired_at }}");
        dayjs.extend(window.dayjs_plugin_relativeTime)

        function updateDeadline_{{ $list->id_pemesanan }}() {
            const now = dayjs()
            const diff = now.diff(expiredAt_{{ $list->id_pemesanan }},
                'second')

            console.log(diff)
            const minutes = Math.floor(diff / 60)
            const seconds = diff % 60

            const timeLeft = `${minutes} menit, ${seconds} detik`;
            document.getElementById("deadline_{{ $list->id_pemesanan }}").textContent = timeLeft
        }
        setInterval(updateDeadline_{{ $list->id_pemesanan }}, 1000)
    @endforeach
</script>

@extends('admin.layout.app')
@section('title', 'Bitme | List Kode')
@section('menu', 'List kode')
@section('submenu', 'Admin')

<style>
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

    #listTotal {
        max-height: 150px;
        overflow-y: scroll;
    }

    #labelUpload {
        height: 150px;
        width: 100%;
        border-radius: 6px;
        border: 3px dashed #999;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- list Tab panes -->
                    <div class="tab-content text-muted">
                        {{-- tab sewa lab --}}
                        <div class="tab-pane active" id="product1" role="tabpanel">
                            <div class="card-body">
                                <div id="customerList">
                                    <div class="table-responsive mb-1" id="tab2">
                                        <table class="table table-hover table-striped">
                                            <tr>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">No Telp</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            @foreach ($codes as $item)
                                                @php
                                                    $user = $item->first()->user; // Ambil informasi pengguna dari baris pertama dalam setiap kelompok
                                                @endphp
                                                <tr>
                                                    @if ($item->first()->qr->status === 'di tukar')
                                                        <td class="text-success text-center">
                                                            <span class="badge badge-soft-success text-uppercase">
                                                                {{ $item->first()->qr->status }}
                                                            </span>
                                                        </td>
                                                    @else
                                                        <td class="text-warning text-center">
                                                            <span class="badge badge-soft-warning text-uppercase">
                                                                {{ $item->first()->qr->status }}
                                                            </span>
                                                        </td>
                                                    @endif
                                                    <td class="text-center">{{ $item->first()->id }}</td>
                                                    <td class="text-center">{{ $user->name }}</td>
                                                    <td class="text-center">{{ $user->no_telp }}</td>
                                                    @if ($item->first()->qr->status === 'di tukar')
                                                        <td class="text-center">
                                                            <button class="btn btn-md btn-success edit-item-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalCheck{{ $user->id }}">check</button>
                                                        </td>
                                                    @else
                                                        <td class="text-center">
                                                            <button class="btn btn-md btn-warning edit-item-btn"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#modalCheck{{ $user->id }}">detail</button>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!--end col-->
    </div>

    {{-- modal check --}}
    @foreach ($codes as $codee)
        @php
            $user = $codee->first()->user; // Ambil informasi pengguna dari baris pertama dalam setiap kelompok
        @endphp
        <div id="modalCheck{{ $user->id }}" class="modal zoomIn" tabindex="-1" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg bg-light">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Verifikasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <form action="{{ route('tukar-kode.verifikasi', $codee->first()->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <table class="table table-hover table-striped">
                                            <tr>
                                                <th class="text-center">Kode</th>
                                                <th class="text-center">Redeemed</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                            @foreach ($codee as $item)
                                                <tr>
                                                    <td class="text-center">{{ $item->qr->code }}</td>
                                                    <td class="text-center">{{ $item->qr->redeemed }}</td>
                                                    <td class="text-center">{{ $item->qr->status }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="card border card-border-primary">
                                        <div class="card-header">
                                            @if ($codee->first()->qr->status === 'baru')
                                                <span
                                                    class="badge badge-soft-warning align-middle fs-10 float-end">{{ $codee->first()->qr->status }}</span>
                                            @else
                                                <span
                                                    class="badge badge-soft-success align-middle fs-10 float-end">{{ $codee->first()->qr->status }}</span>
                                            @endif
                                            <h6 class="card-title mb-0">Detail Pemesanan</h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Nama Pemesan : {{ $user->name }}</p>
                                            <p class="card-text">Alamat : {{ $user->alamat }}</p>
                                            <p class="card-text">No Telp : {{ $user->no_telp }}</p>
                                            <p class="card-text">Email : {{ $user->email }}</p>
                                            <input type="hidden" name="status" value="approved">
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        @if ($codee->first()->qr->status === 'baru')
                                            <button type="submit" name="submit"
                                                class="btn btn-primary">Verifikasi</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    @include('admin.layout.footer')
@endsection

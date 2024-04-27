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
                    <div class="tab-content text-muted">
                        {{-- Tambahkan kode untuk setiap tab atau konten yang diperlukan --}}
                        <div class="tab-pane active" id="product1" role="tabpanel">
                            <div class="card-body">
                                <div id="customerList">
                                    <div class="table-responsive mb-1" id="tab2">
                                        <table class="table table-hover table-striped">
                                            <tr>
                                                <th class="text-center">Status</th>
                                                {{-- <th class="text-center">No</th> --}}
                                                <th class="text-center">Nama</th>
                                                <th class="text-center">No Telp</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            @foreach ($codes as $userCodes)
                                                @php
                                                    $user = $userCodes->first()->user;
                                                    $groupedCodes = $userCodes->groupBy(function ($item) {
                                                        return $item->created_at->format('Y-m-d_H-i-s');
                                                    });
                                                @endphp
                                                @foreach ($groupedCodes as $datetime => $groupedCodesByDatetime)
                                                    @foreach ($groupedCodesByDatetime->groupBy('user_id') as $userId => $groupedCodesByUser)
                                                        <!-- Tampilkan informasi pengguna hanya sekali per kombinasi user_id dan created_at -->
                                                        @if ($loop->first)
                                                            <tr>
                                                                <td class="text-center">
                                                                    @if ($groupedCodesByUser->first()->qr->status === 'di tukar')
                                                                        <span
                                                                            class="badge badge-soft-success text-uppercase">
                                                                            {{ $groupedCodesByUser->first()->qr->status }}
                                                                        </span>
                                                                    @else
                                                                        <span
                                                                            class="badge badge-soft-warning text-uppercase">
                                                                            {{ $groupedCodesByUser->first()->qr->status }}
                                                                        </span>
                                                                    @endif
                                                                </td>
                                                                {{-- <td class="text-center">
                                                                    {{ $groupedCodesByUser->first()->id }}</td> --}}
                                                                <td class="text-center">{{ $user->name }}</td>
                                                                <td class="text-center">{{ $user->no_telp }}</td>
                                                                <td class="text-center">
                                                                    <button class="btn btn-md btn-success edit-item-btn"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#modalCheck_{{ $user->id }}_{{ str_replace(' ', '_', $datetime) }}">check</button>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>

    <!-- Modal verifikasi -->
    @foreach ($codes as $codee)
        @php
            $user = $codee->first()->user;
            $groupedCodes = $codee->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d_H-i-s');
            });
        @endphp
        @foreach ($groupedCodes as $datetime => $groupedCodesByDatetime)
            @php
                $modalId = 'modalCheck_' . $user->id . '_' . str_replace(' ', '_', $datetime);
            @endphp
            <div id="{{ $modalId }}" class="modal zoomIn" tabindex="-1" aria-labelledby="myModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg bg-light">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Verifikasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                        </div>
                        <form action="{{ route('tukar-kode.verifikasi') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <table class="table table-hover table-striped">
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Kode</th>
                                                    <th class="text-center">Status</th>
                                                </tr>
                                                @foreach ($groupedCodesByDatetime as $index => $item)
                                                    <tr>
                                                        <input type="hidden" name="ids[]" value="{{ $item->qr->id }}">
                                                        <td class="text-center">{{ $index + 1 }}</td>
                                                        <td class="text-center">{{ $item->qr->code }}</td>
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
                                            <input type="hidden" name="status" value="approved">
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
                        </form>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach

    @include('admin.layout.footer')
@endsection

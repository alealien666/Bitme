@extends('admin.layout.app')
@section('title', 'Bitme | List Pemesanan')
@section('menu', 'List Pemesanan')
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
                    <!-- list tabs -->
                    <ul class="nav nav-tabs mb-3" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#product1" role="tab"
                                aria-selected="false">
                                All Status
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#product2" role="tab" aria-selected="false">
                                Baru
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#product3" role="tab" aria-selected="false">
                                Di Tukar
                            </a>
                        </li>
                    </ul>

                    <!-- list Tab panes -->
                    <div class="tab-content text-muted">
                        {{-- tab sewa lab --}}
                        <div class="tab-pane active" id="product1" role="tabpanel">
                            <div class="card-body">
                                <div id="customerList">
                                    <div class="row g-4 mb-3">
                                        <div class="col-sm">
                                            <div>
                                                <a href="/Admin/code" class="btn btn-warning"><i
                                                        class="ri-add-line align-bottom me-1"></i> Generate Qr Code</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive mb-1" id="tab2">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center" data-sort="status">status</th>
                                                    <th class="text-center" data-sort="no">No</th>
                                                    <th class="text-center" data-sort="kdoe">Kode</th>
                                                    <th class="text-center" data-sort="created">Di Buat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kode as $index => $list)
                                                    <tr>
                                                        @if ($list->status === 'baru')
                                                            <td class="text-center text-warning">
                                                                <span class="badge badge-soft-warning text-uppercase">
                                                                    {{ $list->status }}
                                                                </span>
                                                            </td>
                                                        @elseif($list->status === 'di tukar')
                                                            <td class="text-center text-success">
                                                                <span class="badge badge-soft-success text-uppercase">
                                                                    {{ $list->status }}
                                                                </span>
                                                            </td>
                                                        @endif
                                                        <td class="text-center">{{ $index + 1 }}</td>
                                                        <td class="text-center">{{ $list->code }}</td>
                                                        <td class="text-center">{{ $list->created_at->diffForHumans() }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- tab-Baru --}}
                        <div class="tab-pane" id="product2" role="tabpanel">
                            <div class="card-body">
                                <div id="customerList">
                                    <div class="table-responsive mb-1" id="tab4">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center" data-sort="status">status</th>
                                                    <th class="text-center" data-sort="no">No</th>
                                                    <th class="text-center" data-sort="kode">Code</th>
                                                    <th class="text-center" data-sort="update">Di Update</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kode as $index => $list)
                                                    @if ($list->status === 'baru')
                                                        <tr>
                                                            <td class="text-center text-warning">
                                                                <span class="badge badge-soft-warning text-uppercase">
                                                                    {{ $list->status }}
                                                                </span>
                                                            </td>
                                                            <td class="text-center">{{ $index + 1 }}</td>
                                                            <td class="text-center">{{ $list->code }}</td>
                                                            <td class="text-center">{{ $list->updated_at->diffForHumans() }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- tab-di tukar --}}
                        <div class="tab-pane" id="product3" role="tabpanel">
                            <div class="card-body">
                                <div id="customerList">
                                    <div class="table-responsive mb-1" id="tab5">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-center" data-sort="status">status</th>
                                                    <th class="text-center" data-sort="no">No</th>
                                                    <th class="text-center" data-sort="kode">Kode</th>
                                                    <th class="text-center" data-sort="no_telpn">Dibuat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kode as $index => $list)
                                                    @if ($list->status === 'di tukar')
                                                        <tr>
                                                            <td class="text-center text-success">
                                                                <span class="badge badge-soft-success text-uppercase">
                                                                    {{ $list->status }}
                                                                </span>
                                                            </td>
                                                            <td class="text-center">{{ $index + 1 }}</td>
                                                            <td class="text-center">{{ $list->kode }}</td>
                                                            <td class="text-center">
                                                                {{ $list->created_at->diffForHumans() }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
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
    @include('admin.layout.footer')
    <script>
        // datatables pada setiap tab
        $(document).ready(function() {
            $('#tab1 table').DataTable();
            $('#tab2 table').DataTable();
            $('#tab3 table').DataTable();
        });

        // belum tepat
        function previewImage() {
            const photo = document.querySelector('#photo');
            const imgPreview = document.querySelector('.img-preview');
            const pesan = document.querySelector('#pesan');

            // console.log(id);

            pesan.style.display = 'none';
            imgPreview.style.display = 'block';

            //data gambar
            const oFReader = new FileReader();
            oFReader.readAsDataURL(photo.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection

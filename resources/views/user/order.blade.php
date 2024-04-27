@include('user.layouts.nav')
<div id="layout-wrapper">
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content overflow-hidden">

        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Order</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="/silab">Home</a></li>
                                    <li class="breadcrumb-item"><a href="/lab">Product</a></li>
                                    <li class="breadcrumb-item active">Order</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-body checkout-tab">

                                <form action="{{ route('orderProduct') }}" method="post">
                                    @csrf
                                    <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                                        <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                            <li class="nav-item" role="presentation" id="personal-info">
                                                <button class="nav-link fs-15 p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true"><i class="ri-user-2-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                                    Personal Info</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link fs-15 p-3" id="pills-bill-address-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-address" type="button" role="tab" aria-controls="pills-bill-address" aria-selected="false" disabled><i class="ri-truck-line fs-16 p-2 bg-soft-primary text-primary rounded-circle align-middle me-2"></i>
                                                    Detail Pesanan</button>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="tab-content" id="pageProfile">
                                        <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel">
                                            <div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="nama-user" class="form-label">Nama</label>
                                                            <input type="text" class="form-control" id="nama-user" name="nama" placeholder="Enter name" value="{{ auth()->user()->name }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="no-telp" class="form-label">No Telp
                                                                (WhatsApp)</label>
                                                            <input type="number" class="form-control" name="notelp" id="no-telp" placeholder="No Telp" value="{{ auth()->user()->no_telp }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="mb-3">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label for="alamat" class="form-label">Alamat</label>
                                                        <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Enter Address" value="{{ auth()->user()->alamat }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->

                                        <div class="tab-pane fade" id="pills-bill-address" role="tabpanel">
                                            <div>
                                                <h5 class="mb-1">Detail Pesanan</h5>
                                                <p class="text-muted mb-4">Informasi Transaksi Anda</p>
                                            </div>

                                            <div class="mt-5">
                                                <div class="row gy-3">
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="form-check">
                                                            <label class="form-check-label" for="shippingAddress01">
                                                                <span class="mb-4 fw-semibold d-block">{{ auth()->user()->email }}</span><br>

                                                                <span class="text-muted fw-normal text-wrap mb-1 d-block" id="shipping-name">Nama :
                                                                    {{ auth()->user()->name }}</span>
                                                                <span class="text-muted fw-normal text-wrap mb-1 d-block" id="shipping-notelp">No Telp :
                                                                    {{ auth()->user()->no_telp }}</span>
                                                                <span class="text-muted fw-normal text-wrap mb-1 d-block" id="shipping-notelp">Alamat :
                                                                    {{ auth()->user()->alamat }}</span>
                                                            </label>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-6 col-sm-6">
                                                        <div class="form-check" id="scroll">
                                                            <label class="form-check-label" for="shippingAddress02">
                                                                <span class="mb-4 fw-semibold d-block text-uppercase">Detail
                                                                    Produk Yang Di Beli</span><br>
                                                                @foreach ($selectedProduct as $item)
                                                                <span class="text-muted mb-2 d-block" id="shipping-product">
                                                                    Nama Product: {{ $item->nama_product }}<br>
                                                                    Rasa: {{ $item->rasa->varian_rasa }}<br>
                                                                    Harga: Rp.
                                                                    {{ number_format($item->harga, 0, ',', '.') }}<br>
                                                                    Jumlah:
                                                                    {{ session('jumlah_beli')[$item->id] }}
                                                                </span>
                                                                <hr>
                                                                @endforeach

                                                            </label>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="mt-4">
                                                    <h5 class="fs-14 mb-3">Total Bayar</h5>
                                                    <div class="row g-4">
                                                        <div class="col-lg-6">
                                                            <div class="form-check card-radio">
                                                                <label class="form-check-label" for="shippingMethod02">
                                                                    <span class="text-wrap text-end">
                                                                        Diskon: @if (session('total_biaya') >= 30000)
                                                                        - Rp 10.000
                                                                        @endif
                                                                    </span>
                                                                    <span class="fs-21 mt-2 text-wrap d-block fw-semibold">Rp:
                                                                        {{ number_format(session('total_biaya'), 0, ',', '.') }}
                                                                    </span>
                                                                    <span class="text-muted fw-normal text-wrap d-block">Expired
                                                                        In 1 Hours</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-start gap-3 mt-4">
                                                <button onclick="redirectPage()" type="button" id="button-disable" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-payment-tab"><i class="ri-bank-card-line label-icon align-middle fs-16 ms-2"></i>Continue
                                                    to Payment</button>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->
                                    </div>
                                    <!-- end tab content -->
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-xl-5">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-0">Pilihan Product</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-card" style="max-height: 300px; overflow-y: scroll">
                                    <table class="table table-borderless align-middle mb-0" id="table">
                                        <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col">Nama Product</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">Pesan Product </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product as $index => $product)
                                            @if ($product->stok === 0)
                                            <tr id="selected_product" class="disable border-bottom">
                                                <td>
                                                    <h5 class="fs-15" name="nama_product">
                                                        {{ $product->nama_product }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <p>{{ $product->stok }}</p>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary w-100 hx">
                                                        Detail Produk
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Detail Produk
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="d-flex">
                                                                        <input type="checkbox" name="selected_product[]" value="{{ $product->id }}" data-harga="{{ $product->harga }}" data-indeks="{{ $index }}" class="form-check-input ms-3 p-2">
                                                                        <p class="ms-2">Checklist untuk
                                                                            memesan produk ini
                                                                        </p>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-10">
                                                                            <p>Nama Produk:
                                                                                {{ $product->nama_product }}
                                                                            </p>
                                                                            <p>Harga: {{ $product->harga }}</p>
                                                                            <p>Varian Rasa:
                                                                                {{ $product->rasa->varian_rasa }}
                                                                            </p>

                                                                            <p>Deskripsi:
                                                                                {{ $product->deskripsi }}
                                                                            </p>

                                                                            <p>Tanggal Expired:
                                                                                {{ $product->tanggal_expired }}
                                                                            </p>


                                                                        </div>
                                                                        <!-- <p class="text-center mt-5">Jumlah</p> -->
                                                                        <div class="col-md-2">
                                                                            <div class="jumlah">
                                                                                <button type="button" class="min"><i class="bi bi-dash-lg" data-indeks="{{ $index }}"></i></button>
                                                                                <input type="hidden" name="jumlah_beli[{{ $product->id }}]" value="0" data-indeks="{{ $index }}">
                                                                                <span class="count">0</span>
                                                                                <button type="button" class="plus" data-indeks="{{ $index }}"><i class="bi bi-plus-lg"></i></button>
                                                                            </div>
                                                                            <p class="text-muted text-center" id="stok" data-stok="{{ $product->stok }}">
                                                                                Stok:
                                                                                {{ $product->stok }}
                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Pesan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @else
                                            <tr id="selected_product" class="border-bottom">
                                                <td>
                                                    <h5 class="fs-15" name="nama_product">
                                                        {{ $product->nama_product }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <p>{{ $product->stok }}</p>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary w-100  " data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $index }}">
                                                        Detail Produk
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal_{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Detail
                                                                        Produk
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img src="{{ asset('img/produk/' . $product->foto_produk) }}" alt="" class="w-100">
                                                                    <div class="d-flex">
                                                                        <input type="checkbox" name="selected_product[]" value="{{ $product->id }}" data-harga="{{ $product->harga }}" data-indeks="{{ $index }}" class="form-check-input ms-3 p-2">
                                                                        <p class="ms-2">Checklist untuk
                                                                            memesan produk ini
                                                                        </p>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-10">
                                                                            <p>Nama Produk:
                                                                                {{ $product->nama_product }}
                                                                            </p>
                                                                            <p>Harga: {{ $product->harga }}
                                                                            </p>
                                                                            <p>Varian Rasa:
                                                                                {{ $product->rasa->varian_rasa }}
                                                                            </p>
                                                                            <p>Deskripsi:
                                                                                {{ $product->deskripsi }}
                                                                            </p>
                                                                            <p>Tanggal Expired:
                                                                                {{ $product->tanggal_expired }}
                                                                            </p>
                                                                        </div>
                                                                        <p class="text-center mt-5">Jumlah
                                                                        </p>
                                                                        <div class="col-md-8">
                                                                            <div class="jumlah">
                                                                                <button type="button" class="min"><i class="bi bi-dash-lg" data-indeks="{{ $index }}"></i></button>
                                                                                <input type="hidden" name="jumlah_beli[{{ $product->id }}]" value="0" data-indeks="{{ $index }}">
                                                                                <span class="count">0</span>
                                                                                <button type="button" class="plus" data-indeks="{{ $index }}"><i class="bi bi-plus-lg"></i></button>
                                                                            </div>
                                                                            <p class="text-muted text-center" id="stok" data-stok="{{ $product->stok }}">
                                                                                Stok:
                                                                                {{ $product->stok }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                </td>
                                            </tr>
                                            @else
                                            <tr id="selected_product" class="border-bottom">
                                                <td>
                                                    <h5 class="fs-15" name="nama_product">
                                                        {{ $product->nama_product }}
                                                    </h5>
                                                </td>
                                                <td>
                                                    <p>{{ $product->stok }}</p>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-primary w-100  " data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $index }}">
                                                        Detail Produk
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal_{{ $index }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Detail
                                                                        Produk
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img src="{{ asset($product->foto_produk) }}" alt="" class="w-100">
                                                                    <div class="d-flex">
                                                                        <input type="checkbox" name="selected_product[]" value="{{ $product->id }}" data-harga="{{ $product->harga }}" data-indeks="{{ $index }}" class="form-check-input ms-3 p-2">
                                                                        <p class="ms-2">Checklist untuk
                                                                            memesan produk ini
                                                                        </p>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-md-10">
                                                                            <p>Nama Produk:
                                                                                {{ $product->nama_product }}
                                                                            </p>
                                                                            <p>Harga: {{ $product->harga }}
                                                                            </p>
                                                                            <p>Varian Rasa:
                                                                                {{ $product->rasa->varian_rasa }}
                                                                            </p>
                                                                            <p>Deskripsi:
                                                                                {{ $product->deskripsi }}
                                                                            </p>
                                                                            <p>Tanggal Expired:
                                                                                {{ $product->tanggal_expired }}
                                                                            </p>
                                                                        </div>
                                                                        <p class="text-center mt-5">Jumlah
                                                                        </p>
                                                                        <div class="col-md-2">
                                                                            <div class="jumlah">
                                                                                <button type="button" class="min"><i class="bi bi-dash-lg" data-indeks="{{ $index }}"></i></button>
                                                                                <input type="hidden" name="jumlah_beli[{{ $product->id }}]" value="0" data-indeks="{{ $index }}">
                                                                                <span class="count">0</span>
                                                                                <button type="button" class="plus" data-indeks="{{ $index }}"><i class="bi bi-plus-lg"></i></button>
                                                                            </div>
                                                                            <p class="text-muted text-center" id="stok" data-stok="{{ $product->stok }}">
                                                                                Stok:
                                                                                {{ $product->stok }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Pilih</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                </div>
                            </div>
                            </td>
                            </tr>
                            @endif
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                        <div class="table-responsive table-card pt-4">
                            <table class="table table-borderless align-middle mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-semibold" colspan="2">Sub Total :</td>
                                        <td class="fw-semibold text-end" id="subtotal"></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-semibold" colspan="2">Diskon :</td>
                                        <td class="fw-semibold text-end text-danger" id="diskon"> </td>
                                    </tr>
                                    <tr class="table-active">
                                        <th colspan="2">Total (Rp) :</th>
                                        <td class="text-end fw-semibold" name="totalHarga" id="total">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

            </div>
            <div class="d-flex align-items-center mb-3">
                <button type="submit" class="btn btn-primary btn-label right" id="buttonPesan" onclick="disableProfile()"><i class="ri-truck-line label-icon align-middle fs-16 ms-2"></i>Pesan
                    Sekarang</button>
            </div>
            <!-- end col -->
            </form>
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</div>

<!-- End Page-content -->

@include('user.layouts.footer')
<!-- end main content-->

</div>
<!-- END layout-wrapper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
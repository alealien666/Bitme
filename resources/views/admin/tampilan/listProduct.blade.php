@extends('admin.layout.app')
@section('title', 'List Product')
@section('menu', 'List Product')
@section('submenu', 'Admin')

<style>
    #myTable_filter label input[type="search"] {
        padding: 8px 20px;
        font-size: 14px;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">List Product Bitme</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm">
                                <div>
                                    <button type="button" class="btn btn-warning add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#addModal"><i
                                            class="ri-add-line align-bottom me-1"></i> Tambah Product</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mb-1 mt-3">
                            <table class="table align-middle mb-0" id="myTable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" data-sort="no">No</th>
                                        <th class="text-center" data-sort="kategori">Varian Rasa</th>
                                        <th class="text-center" data-sort="jenis_alat">Nama Product</th>
                                        <th class="text-center" data-sort="foto">Tanggal Expired</th>
                                        <th class="text-center" data-sort="harga">Harga</th>
                                        <th class="text-center" data-sort="jumlah">Stock</th>
                                        <th class="text-center" data-sort="action">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listProduct as $index => $product)
                                        <tr>
                                            <th class="text-center">{{ $index + 1 }}</th>
                                            <td class="text-center">{{ $product->rasa->varian_rasa }}</td>
                                            <td class="text-center">{{ $product->nama_product }}</td>
                                            <td class="text-center">{{ $product->tanggal_expired }}</td>
                                            <td class="text-center">Rp. {{ $product->harga }}</td>
                                            <td class="text-center">{{ $product->stok }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-md p-2 btn-success edit-item-btn me-2"
                                                    data-bs-toggle="modal" data-bs-target="#editJenis{{ $product->id }}"><i
                                                        class="bi bi-pencil-fill"></i></button>
                                                <button class="btn btn-md p-2 btn-danger remove-item-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteJenis{{ $product->id }}"><i
                                                        class="bi bi-trash-fill"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- add modal --}}
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah List Produk Bitme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form method="POST" action="{{ route('Admin.list-product.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="rasa">Pilih Varian Rasa</label>
                            <select class="form-select" id="rasa" name="rasa">
                                <option selected>Pilih Varian Rasa</option>
                                @foreach ($rasas as $rasa)
                                    <option value="{{ $rasa->id }}">{{ $rasa->varian_rasa }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_product" class="form-label">Masukkan Nama Product</label>
                            <input type="text" name="nama_product" id="nama_product" class="form-control" required
                                autocomplete="off" />
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Expired</label>
                            @php
                                $today = now()->format('Y-m-d');
                            @endphp
                            <input type="date" name="tanggal" id="tanggal" class="form-control"
                                min="{{ $today }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Masukkan Stok</label>
                            <input type="number" name="stok" id="stok" class="form-control" required
                                autocomplete="off" />
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Masukkan Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" required
                                autocomplete="off" />
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Masukkan Deskripsi Produk</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" required>
                            </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Masukkan Foto</label>
                            <img class="img-preview img-fluid mb-3 col-md-6">
                            <input type="file" onchange="previewImage()" name="foto" id="foto"
                                class="form-control" autocomplete="off" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" name="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($listProduct as $product)
        {{-- update modal --}}
        <div class="modal fade" id="editJenis{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="exampleModalLabel">Edit List Produk Bitme</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="close-modal"></button>
                    </div>
                    <form method="POST" action="{{ route('Admin.list-product.update', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="rasa">Pilih Varian Rasa</label>
                                <select class="form-select" id="rasa" name="rasa">
                                    <option selected>Pilih Varian Rasa</option>
                                    @foreach ($rasas as $rasa)
                                        <option value="{{ $rasa->id }}"
                                            @if ($rasa->varian_rasa === $product->rasa->varian_rasa) selected @endif>
                                            {{ $rasa->varian_rasa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_product" class="form-label">Masukkan Nama Product</label>
                                <input type="text" value="{{ $product->nama_product }}" name="nama_product"
                                    id="nama_product" class="form-control" required autocomplete="off" />
                            </div>
                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Masukkan Tanggal Expired</label>
                                @php
                                    $today = now()->format('Y-m-d');
                                @endphp
                                <input type="date" name="tanggal" class="form-control" id="tanggal"
                                    min="{{ $today }}" value="{{ $product->tanggal_expired }}">
                            </div>
                            <div class="mb-3">
                                <label for="stok" class="form-label">Masukkan Stok</label>
                                <input type="number" value="{{ $product->stok }}" name="stok" id="stok"
                                    class="form-control" required autocomplete="off" />
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Masukkan Harga</label>
                                <input type="number" value="{{ $product->harga }}" name="harga" id="harga"
                                    class="form-control" required autocomplete="off" />
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Masukkan Deskripsi Produk</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi"cols="30" rows="10" required>
                                    {{ $product->deskripsi }}
                                </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Masukkan Foto</label>
                                <input type="hidden" name="oldImage" value={{ $product->foto_produk }}>
                                @if ($product->foto_produk)
                                    <img class="img-preview img-fluid mb-3 d-block"
                                        src="{{ asset('img/produk/' . basename($product->foto_produk)) }}">
                                @else
                                    <img class="img-preview img-fluid mb-3 col-md-6">
                                @endif
                                <input type="file" onchange="previewImage()" name="foto" id="foto"
                                    class="form-control" autocomplete="off"
                                    value="{{ old(basename($product->foto_produk)) }}" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" name="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- delete modal --}}
        <div class="modal fade zoomIn" id="deleteJenis{{ $product->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Anda Yakin ?</h4>
                                <p class="text-muted mx-4 mb-0">Anda Yakin Mau Menghapus Data Ini ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Batal</button>
                            <form action="{{ route('Admin.list-product.destroy', $product->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn w-sm btn-danger "
                                    id="delete-record{{ $product->id }}">Ya, Hapus!</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- review image --}}
    <script>
        function previewImage() {
            const photo = document.querySelector('#foto');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            //data gambar
            const oFReader = new FileReader();
            oFReader.readAsDataURL(photo.files[0]);

            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
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

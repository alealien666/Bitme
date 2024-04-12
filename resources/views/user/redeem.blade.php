@extends('layouts.nav')
@section('konten')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h3 style="margin-top: 10rem">Kumpulkan 10 Kode Lalu Tukarkan Dan Dapatkan Bingkisan Menarik</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="card p-5 rounded shadow-lg mt-4">
                <form method="post" action="{{ route('redeemKode') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">masukkan kode di sini</label>
                        @if (isset($kode))
                            <input type="text" class="form-control" value="{{ $kode }}" name="code">
                        @else
                            <input type="text" class="form-control" name="code">
                        @endif
                        <div id="emailHelp" class="form-text">anda tidak bisa memasukkan kode yang telah di redeem
                            sebelumnya</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Redeem</button>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-5 rounded shadow-lg mt-4">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">semua kode yang sudah anda redeem akan terkumpul
                        di sini</label>
                    @foreach ($qrCode as $item)
                        <h1>{{ $item->code }}</h1>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Tukar Kode</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successMessage = '{{ session('success') }}';
            var errorMessage = '{{ session('error') }}';

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: successMessage
                });
            }

            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: errorMessage
                });
            }
        });
    </script>
@endsection

@extends('user.layouts.nav')
@section('konten')
    <h3 style="margin-top: 10rem">Kumpulkan 30 Kode Lalu Tukarkan Dan Dapatkan Bingkisan Menarik</h3>
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
            <form action="{{ route('tukarCode') }}" method="post" id="tukarCodeForm">
                @csrf
                <div class="card p-5 rounded shadow-lg mt-4">
                    <p class="text-capitalize">Semua kode yang sudah anda redeem akan terkumpul di sini</p>
                    <div class="mb-3" style="height: 150px; overflow-y:scroll;">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($qrCode as $index => $item)
                                @if ($item->tukar === 0 && $item->redeemed === 1)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->code }}</td>
                                        <td>
                                            <input type="checkbox" name="kode[]"
                                                class="form-check-input me-1 kode-checkbox" id="kode{{ $index }}"
                                                value="{{ $item->id }}">
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <button type="submit" class="btn btn-primary" id="tukarKodeBtn" disabled>Tukar Kode</button>
                </div>
            </form>
        </div>
    </div>
    @include('user.layouts.footer')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.kode-checkbox');
            const submitBtn = document.getElementById('tukarKodeBtn');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const checkedCheckboxes = document.querySelectorAll('.kode-checkbox:checked');
                    if (checkedCheckboxes.length >= 30) {
                        submitBtn.removeAttribute('disabled');
                    } else {
                        submitBtn.setAttribute('disabled', 'disabled');
                    }
                });
            });
        });
    </script>
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

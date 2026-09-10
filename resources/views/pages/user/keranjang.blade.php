@extends('layouts.app')

@section('title', 'Kelola Alat')

@section('content')
<div class="container py-5">
    <h2>Keranjang Anda</h2>
    <p>Daftar Barang Sewa</p>

    <div class="row">
        <div class="col-lg-8">
            @if(session('keranjang') && count(session('keranjang')) > 0)
                @foreach(session('keranjang') as $id => $item)
                <div class="card mb-3 p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('storage/images_alat/'.$item['foto']) }}" width="80" style="object-fit:cover; border-radius:8px;">
                            <div>
                                <h6>{{ $item['nama'] }}</h6>
                                <p class="text-danger">Rp{{ number_format($item['harga']) }}/hari</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <!-- FORM UPDATE JUMLAH -->
                            <form action="{{ route('keranjang.update', $id) }}" method="POST" class="d-flex">
                                @csrf @method('PUT')
                                <button type="button" class="btn btn-sm border btn-minus">-</button>
                                <input type="number" name="jumlah" value="{{ $item['jumlah'] }}" class="form-control form-control-sm text-center jumlah" style="width:50px;" readonly>
                                <button type="button" class="btn btn-sm border btn-plus">+</button>
                            </form>

                            <!-- FORM HAPUS -->
                            <form action="{{ route('keranjang.destroy', $id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light text-danger">🗑️</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <p>Keranjang masih kosong</p>
            @endif

            <!-- FORM BIODATA -->
            <h4 class="mt-5">Formulir Pengambilan & Biodata</h4>
            <form action="{{ route('sewa.checkout') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nomor HP</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Pengambilan</label>
                        <input type="date" name="tgl_ambil" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Tanggal Pengembalian</label>
                        <input type="date" name="tgl_kembali" class="form-control" required>
                    </div>
                </div>
                <button class="btn btn-warning w-100">Ajukan & Konfirmasi Rental</button>
            </form>
        </div>

        <!-- RINGKASAN ORDER -->
        <div class="col-lg-4">
            <div class="card bg-dark text-white p-3">
                <h5>Ringkasan Order</h5>
                @php $total = 0; @endphp
                @foreach(session('keranjang', []) as $item)
                    <p>{{ $item['nama'] }} x {{ $item['jumlah'] }}</p>
                    @php $total += $item['harga'] * $item['jumlah']; @endphp
                @endforeach
                <hr>
                <p>Subtotal: Rp{{ number_format($total) }}/hari</p>
                <p>Total = Subtotal x Jumlah Hari</p>
            </div>
        </div>
    </div>
</div>

<script>
// JS buat tombol +/- auto submit
document.querySelectorAll('.btn-plus').forEach(btn => {
    btn.onclick = function() {
        let input = this.parentElement.querySelector('.jumlah');
        input.value = parseInt(input.value) + 1;
        this.closest('form').submit();
    }
});
document.querySelectorAll('.btn-minus').forEach(btn => {
    btn.onclick = function() {
        let input = this.parentElement.querySelector('.jumlah');
        if(parseInt(input.value) > 1){
            input.value = parseInt(input.value) - 1;
            this.closest('form').submit();
        }
    }
});
</script>
@endsection
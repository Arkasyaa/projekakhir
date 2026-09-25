@extends('layouts.app')

@section('title', 'Kelola Alat')

@section('content')
<div class="container py-20">
    <div class="mt-6 mb-4 pl-3 border-l-4 border-[#E67E22] text-xl font-semibold font-['Instrument_Sans'] text-zinc-900">
        <h1>Keranjang Anda</h1>
    </div>

    <h1 class="text-xl font-semibold">Daftar Barang Sewa</h1>

    <div class="row py-2">
        <div class="col-lg-8">

            @if(session('keranjang') && count(session('keranjang')) > 0)

                @foreach(session('keranjang') as $id => $item)
                <div class="card mb-3 p-3">
                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('storage/images_alat/'.$item['foto']) }}"
                                 width="80"
                                 style="object-fit:cover; border-radius:8px;">

                            <div>
                                <h6>{{ $item['nama'] }}</h6>
                                <p class="text-danger">
                                    Rp{{ number_format($item['harga']) }}/hari
                                </p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">

                            <!-- FORM UPDATE JUMLAH -->
                            <form action="{{ route('keranjang.update', $id) }}"
                                  method="POST"
                                  class="d-flex">

                                @csrf
                                @method('PUT')

                                <button type="button"
                                        class="btn btn-sm border btn-minus">
                                    -
                                </button>

                                <input type="number"
                                       name="jumlah"
                                       value="{{ $item['jumlah'] }}"
                                       class="form-control form-control-sm text-center jumlah"
                                       style="width:50px;"
                                       readonly>

                                <button type="button"
                                        class="btn btn-sm border btn-plus">
                                    +
                                </button>

                            </form>

                            <!-- FORM HAPUS -->
                            <form action="{{ route('keranjang.destroy', $id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-light text-danger">
                                    🗑️
                                </button>

                            </form>

                        </div>
                    </div>
                </div>
                @endforeach

            @else

                <p>Keranjang masih kosong</p>

            @endif


            <!-- FORM BIODATA -->
            <h4 class="mt-5 text-xl font-semibold">Formulir Pengambilan & Biodata</h4>
            <hr class="py-2">

            <form action="{{ route('sewa.checkout') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Nomor HP</label>
                    <input type="text"
                           name="no_hp"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat"
                              class="form-control"
                              required></textarea>
                </div>


                <!-- TANGGAL -->
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Tanggal Pengambilan</label>

                        <input type="date"
                               name="tgl_ambil"
                               id="tgl_ambil"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tanggal Pengembalian</label>

                        <input type="date"
                               name="tgl_kembali"
                               id="tgl_kembali"
                               class="form-control"
                               required>
                    </div>

                </div>


                <!-- JUMLAH HARI -->
                <div class="mb-3">
                    <label>Jumlah Hari Sewa</label>

                    <input type="text"
                           id="jumlah_hari"
                           class="form-control"
                           value="Belum dipilih"
                           readonly>
                </div>


                <button type="submit"
                        class="btn btn-warning w-100">
                    Ajukan & Konfirmasi Rental
                </button>

            </form>

        </div>


        <!-- RINGKASAN ORDER -->
        <div class="col-lg-4">

            <div class="card bg-dark text-white p-3">

                <h5>Ringkasan Order</h5>

                @php
                    $subtotal = 0;
                @endphp

                @foreach(session('keranjang', []) as $item)

                    <p>
                        {{ $item['nama'] }} x {{ $item['jumlah'] }}
                    </p>

                    @php
                        $subtotal += $item['harga'] * $item['jumlah'];
                    @endphp

                @endforeach

                <hr>

                <p>
                    Subtotal:
                    Rp{{ number_format($subtotal) }}/hari
                </p>

                <p>
                    Jumlah Hari:
                    <span id="ringkasan_hari">-</span>
                </p>

                <p class="fw-bold">
                    Total:
                    Rp<span id="ringkasan_total">-</span>
                </p>

            </div>

        </div>

    </div>
</div>


<script>

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

            if (parseInt(input.value) > 1) {

                input.value = parseInt(input.value) - 1;

                this.closest('form').submit();

            }

        }

    });


    const tanggalAmbil = document.getElementById('tgl_ambil');
    const tanggalKembali = document.getElementById('tgl_kembali');

    const jumlahHariInput = document.getElementById('jumlah_hari');
    const ringkasanHari = document.getElementById('ringkasan_hari');
    const ringkasanTotal = document.getElementById('ringkasan_total');

    const subtotal = {{ $subtotal }};


    function hitungRental() {

        if (!tanggalAmbil.value || !tanggalKembali.value) {
            jumlahHariInput.value = 'Belum dipilih';
            ringkasanHari.innerText = '-';
            ringkasanTotal.innerText = '-';
            return;
        }


        const ambil = new Date(tanggalAmbil.value);
        const kembali = new Date(tanggalKembali.value);

        const selisih = kembali - ambil;

        const hari = Math.ceil(
            selisih / (1000 * 60 * 60 * 24)
        );

        if (hari < 1) {

            jumlahHariInput.value = 'Tanggal tidak valid';
            ringkasanHari.innerText = '-';
            ringkasanTotal.innerText = subtotal.toLocaleString('id-ID');

            return;
        }


        jumlahHariInput.value = hari + ' hari';
        ringkasanHari.innerText = hari + ' hari';


        const total = subtotal * hari;


        ringkasanTotal.innerText =
            total.toLocaleString('id-ID');

    }

    tanggalAmbil.addEventListener('change', function() {

        tanggalKembali.min = tanggalAmbil.value;

        hitungRental();

    });


    tanggalKembali.addEventListener('change', function() {

        hitungRental();

    });

</script>

@endsection
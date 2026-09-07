@extends('layouts.app')

@section('title', 'Kelola Alat')

@section('content')
<div class="bg-[#FCFBF6]">
<div class="max-w-6xl mx-auto px-4 lg:px-10 py-20">
        <div class="flex items-center justify-between">       
            <h1 class="font-['Outfit'] text-[30px] font-bold py-[40px] ">Kelola Alat</h1>
            <a href="{{ route('admin.alat.create') }}" 
            class="flex items-center gap-1.5 px-4 py-2 bg-[#C75A3A] hover:bg-[#B34E31] text-white text-sm font-semibold rounded-lg shadow-sm transition">
                <i class="fa-solid fa-plus"></i>
                <span>TAMBAH ALAT BARU</span>
            </a>
        </div>

    <div>
        <div>
            <div class="py-2">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('admin.alat.index') }}" method="GET">
                    <div style="position:relative; display:inline-block; padding:8px 12px 8px 35px; border:1px solid #ddd; border-radius:8px; width:1037px; background:#fff;">
                        <i class="fa-solid fa-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#999;"></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama alat..."
                            style="width:700px; padding:2px 12px "
                        >

                        <select
                            name="kategori"
                            onchange="this.form.submit()"
                            style="border:1px solid #ddd; outline:none; background:#fff; padding:3px 9px; font-size:14px; border-radius:12px;">
                            <option value="all">Semua Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>

                        <select
                            name="status" onchange="this.form.submit()"
                            style="border:1px solid #ddd; outline:none; background:#fff; padding:3px 9px; font-size:14px; border-radius:12px;">
                            <option value="all">Status: Semua</option>
                            <option value="Tersedia" {{ request('status') == 'Tersedia' ? 'selected' : '' }}>Status: Tersedia</option>
                            <option value="habis" {{ request('status') == 'habis' ? 'selected' : '' }}>Status: Habis</option>
                        </select>

                    </div>

                    <button type="submit" style="padding:10px 16px; border:1px solid #ddd; border-radius:8px ">Cari</button>
                </form>
            </div>
        </div>
        <div>
                <table class="table border rounded-lg border-[#5C645D] overflow-hidden w-full table-bordered font-['Instrument_Sans']">
                    <thead>
                        <tr class="font-['Instrument_Sans'] text-center text-[15px] font-semibold">
                            <th class="!text-[#5C645D]">No</th>
                            <th class="!text-[#5C645D]">Foto</th>
                            <th class="!text-[#5C645D]">Nama Alat</th>
                            <th class="!text-[#5C645D]">Kategori</th>
                            <th class="!text-[#5C645D]">Harga</th>
                            <th class="!text-[#5C645D]">Stok</th>
                            <th class="!text-[#5C645D]">Status</th>
                            <th class="!text-[#5C645D]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($alats as $alat)
                        <tr class="text-center font-['Outfit'] text-center text-[13px] font-semibold">
                            <td class="!py-[18px] align-middle">{{ $loop->iteration }}</td>
                            <td class="!py-[18px] align-middle">
                                @if($alat->foto)
                                    <img src="{{ asset('storage/images_alat/'.$alat->foto) }}" width="60">
                                @endif
                            </td>
                            <td class="!py-[18px] align-middle">{{ $alat->nama_alat }}</td>
                            <td class="!py-[18px] align-middle font-['Instrument_Sans'] font-normal">{{ $alat->kategori }}</td>
                            <td class="!py-[18px] align-middle !text-[#D96B27]">Rp{{ number_format($alat->harga) }}</td>
                            <td class="!py-[18px] align-middle font-normal">{{ $alat->stok }}</td>
                            <td class="!py-[18px] align-middle !text-[#10B981]"><span class="rounded-full bg-[#D1FAE5] py-[2px] px-3">{{ $alat->status }}</span></td>
                            <td class="!py-[18px] align-middle">
                                <div class="flex gap-2 text-center !align-center">
                                    <div>
                                        <a href="#" class="rounded-lg p-2 bg-[#FEF3C7]">
                                            <i class="text-[#F59E0B] fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="#"
                                            onclick="actionDestroy('{{ route('admin.alat.destroy', $alat->id) }}')"
                                            class="bg-[#FEE2E2] rounded-lg p-2">
                                            <i class="text-[#DC2626] fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center">Belum ada data alat</td></tr>
                        @endforelse
                    </tbody>
                </table>
               <div style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
                
                    <div style="font-size:14px; color:#666;">
                        Menampilkan {{ $alats->firstItem() }}-{{ $alats->lastItem() }} dari {{ $alats->total() }} entri
                    </div>
                
                    <div>
                        {{ $alats->withQueryString()->links() }}
                    </div>
                
                </div>
            </div>
        </div>

    {{-- <div>
        <p>
            Menampilkan {{ $alats->firstItem() ?? 0 }}-{{ $alats->lastItem() ?? 0 }}
            dari {{ $alats->total() }} entri
        </p>
        {{ $alats->links() }}
    </div> --}}

</div>
</div>
</div>
<form action="" id="form-destroy" method="POST">
    @csrf
    @method('DELETE')
</form>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/4.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.26.25/sweetalert2.all.min.js"></script>

<script>
function actionDestroy(url) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: 'Data yang dihapus tidak bisa dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $('#form-destroy').attr('action', url);
            $('#form-destroy').submit();
        }
    });
}
</script>

@endsection

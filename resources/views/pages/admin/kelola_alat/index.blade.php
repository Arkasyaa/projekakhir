@extends('layouts.app')

@section('title', 'Kelola Alat')

@section('content')
<div class="max-w-6xl mx-auto px-4 lg:px-10 py-20">
        <div class="flex items-center justify-between">       
            <h1 class="text-xl md:text-2xl font-bold text-gray-900">Kelola Alat</h1>
            <a href="{{ route('admin.alat.create') }}" 
            class="flex items-center gap-1.5 px-4 py-2 bg-[#C75A3A] hover:bg-[#B34E31] text-white text-sm font-semibold rounded-lg shadow-sm transition">
                <i class="fa-solid fa-plus"></i>
                <span>TAMBAH ALAT BARU</span>
            </a>
        </div>
        

    <div class="py-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <form method="GET" action="{{ route('admin.alat.index') }}">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Alat..."
            >
            <button type="submit">Cari</button>
        </form>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Alat</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alats as $alat)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($alat->foto)
                        <img src="{{ asset('storage/images_alat/'.$alat->foto) }}" width="60">
                    @endif
                </td>
                <td>{{ $alat->nama_alat }}</td>
                <td>{{ $alat->kategori }}</td>
                <td>Rp{{ number_format($alat->harga) }}</td>
                <td>{{ $alat->stok }}</td>
                <td>{{ $alat->status }}</td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                    <a href="#"
                        onclick="actionDestroy('{{ route('admin.alat.destroy', $alat->id) }}')"
                        class="btn btn-sm btn-danger">
                        Hapus
                    </a>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">Belum ada data alat</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- <div>
        <p>
            Menampilkan {{ $alats->firstItem() ?? 0 }}-{{ $alats->lastItem() ?? 0 }}
            dari {{ $alats->total() }} entri
        </p>
        {{ $alats->links() }}
    </div> --}}

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

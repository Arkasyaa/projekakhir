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
                    <option value="Disewa" {{ request('status') == 'Disewa' ? 'selected' : '' }}>Status: Disewa</option>
                </select>
                
            </div>
            
            <button type="submit" style="padding:10px 16px; border:1px solid #ddd; border-radius:8px ">Cari</button>
      </form>
    </div>

    <table class="table overflow-x-auto w-full table-bordered">
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
                    <a href="{{ route('admin.alat.edit', $alat->id) }}" class="btn btn-warning btn-sm">Edit</a>
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

    <div style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
    
        <!-- KIRI: Menampilkan 1-5 dari 36 -->
        <div style="font-size:14px; color:#666;">
            Menampilkan {{ $alats->firstItem() }}-{{ $alats->lastItem() }} dari {{ $alats->total() }} entri
        </div>

        <!-- KAN: Tombol 1 2 3 -->
        <div>
            {{ $alats->withQueryString()->links() }}
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
{{-- <div>
        <p>
            Menampilkan {{ $alats->firstItem() ?? 0 }}-{{ $alats->lastItem() ?? 0 }}
            dari {{ $alats->total() }} entri
        </p>
        {{ $alats->links() }}
    </div> --}}
@endsection

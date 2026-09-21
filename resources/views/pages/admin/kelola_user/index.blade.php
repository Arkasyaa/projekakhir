@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="bg-[#FCFBF6]">
<div class="max-w-6xl mx-auto px-4 lg:px-10 py-20">
    <div class="flex items-center justify-between">       
            <h1 class="font-['Outfit'] text-[30px] font-bold py-[40px] ">Kelola User</h1>
            <a href="{{ route('admin.kelola_user.create') }}" 
            class="flex items-center gap-1.5 px-4 py-2 bg-[#C75A3A] hover:bg-[#B34E31] text-white text-sm font-semibold rounded-lg shadow-sm transition">
                <i class="fa-solid fa-plus"></i>
                <span>TAMBAH USER BARU</span>
            </a>
    </div>

    <div>
        <div>
            <div class="py-2">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <form action="{{ route('admin.kelola_user.index') }}" method="GET">
                    <div style="position:relative; display:inline-block; padding:8px 12px 8px 35px; border:1px solid #ddd; border-radius:8px; width:1037px; background:#fff;">
                        <i class="fa-solid fa-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#999;"></i>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama user..."
                            style="width:700px; padding:2px 12px "
                        >

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
                            <th class="!text-[#5C645D]">PROFIL PELANGGAN</th>
                            <th class="!text-[#5C645D]">NO HP</th>
                            <th class="!text-[#5C645D]">ALAMAT RUMAH</th>
                            <th class="!text-[#5C645D]">TOTAL SEWA</th>
                            <th class="!text-[#5C645D]">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                        <tr class="text-center font-['Outfit'] text-center text-[13px] font-semibold">
                            <td class="!py-[18px] align-middle">{{ $loop->iteration }}</td>
                            <td class="!py-[18px] align-middle font-bold">{{ $user->name }} <div class="font-semibold">{{ $user->email }}</div></td>
                            <td class="!py-[18px] align-middle font-normal">{{ $user->no_hp }}</td>
                            <td class="!py-[18px] align-middle font-normal">{{ $user->alamat }}</td>
                            <td class="!py-[18px] align-middle">{{ $user->total_sewa ?? 0 }} Kali sewa</td>
                            <td class="!py-[18px] align-middle">
                                <div class="flex gap-2 text-center !align-center">
                                    <div>
                                        <a href="{{ route('admin.kelola_user.edit', $user->id) }}" class="rounded-lg p-2 bg-[#FEF3C7]">
                                            <i class="text-[#F59E0B] fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="#"
                                            onclick="actionDestroy('{{ route('admin.kelola_user.destroy', $user->id) }}')"
                                            class="bg-[#FEE2E2] rounded-lg p-2">
                                            <i class="text-[#DC2626] fa-solid fa-trash"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center">Belum ada data user</td></tr>
                        @endforelse
                    </tbody>
                </table>
               <div style="display:flex; justify-content:space-between; align-items:center; margin-top:20px;">
                
                    <div style="font-size:14px; color:#666;">
                        Menampilkan {{ $users->firstItem() }}-{{ $users->lastItem() }} dari {{ $users->total() }} entri
                    </div>
                
                    <div>
                        {{ $users->withQueryString()->links() }}
                    </div>
                
                </div>
        </div>
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


{{-- @extends('layouts.app')

@section('title', 'Kelola User')

@section('content')
<div class="bg-[#FCFBF6]">
    <div class="max-w-6xl mx-auto px-4 lg:px-10 py-20">
        <div class="flex items-center justify-between">       
                <h1 class="font-['Outfit'] text-[30px] font-bold py-[40px] ">Kelola User</h1>
                <a href="{{ route('admin.kelola_user.create') }}" 
                class="flex items-center gap-1.5 px-4 py-2 bg-[#C75A3A] hover:bg-[#B34E31] text-white text-sm font-semibold rounded-lg shadow-sm transition">
                    <i class="fa-solid fa-plus"></i>
                    <span>TAMBAH USER BARU</span>
        </div>
        <div>
            <div>
                <div class="py-2">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form method="GET" action="{{ route('admin.kelola_user.index') }}">
                    <div style="position:relative; display:inline-block; padding:8px 12px 8px 35px; border:1px solid #ddd; border-radius:8px; width:1037px; background:#fff;">
                        <i class="fa-solid fa-search" style="position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#999;"></i>
                            <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari nama user..."
                                    style="width:700px; padding:2px 12px "
                                >
                    </div>
                        <button type="submit" style="padding:10px 16px; border:1px solid #ddd; border-radius:8px ">Cari</button>
                    </form>
                </div>
            </div>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>PROFIL PELANGGAN</th>
                <th>NOMOR HP</th>
                <th>ALAMAT RUMAH</th>
                <th>TOTAL SEWA</th>
                <th>AKSI</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $index => $user)
                <tr>
                    <td>{{ $users->firstItem() + $index }}</td>
                    <td>
                        <img src="{{ asset('images/profile-default.png') }}" alt="Profil User" class="w-24 h-24 rounded-full object-cover">
                        <div>{{ $user->name }}</div>
                        <div>{{ $user->email }}</div>
                    </td>
                    <td>{{ $user->no_hp }}</td>
                    <td>{{ $user->alamat }}</td>
                    <td>{{ $user->total_sewa ?? 0 }} Kali sewa</td>
                    <td>
                        <a href="{{ route('admin.kelola_user.show', $user->id) }}">Lihat</a>
                        <a href="{{ route('admin.kelola_user.edit', $user->id) }}">Edit</a>
                        <form action="{{ route('admin.kelola_user.destroy', $user->id) }}">
                            <a href="#"
                            onclick="actionDestroy('{{ route('admin.alat.destroy', $user->id) }}')">
                            Hapus
                            </a>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

      
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
@endsection --}}

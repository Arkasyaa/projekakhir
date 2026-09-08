@extends('layouts.app')

@section('title', 'Kelola User')

@section('content')

    <div>
        <h1>Kelola User</h1>
        <a href="{{ route('admin.kelola_user.create') }}">
            Tambah User Baru
        </a>
    </div>

    <div>
        <form method="GET" action="{{ route('admin.kelola_user.index') }}">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama user..."
            >
            <button type="submit">Cari</button>
        </form>
    </div>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

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

        {{-- <div>
        <p>
        Menampilkan {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }}
        dari {{ $users->total() }} entri
        </p>
        {{ $users->links() }}
        </div> --}}

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

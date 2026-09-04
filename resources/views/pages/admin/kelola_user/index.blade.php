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
                        <img
                            src="{{ $user->foto_profil ? asset('storage/'.$user->foto_profil) : asset('images/default-avatar.png') }}"
                            alt="{{ $user->name }}"
                        >
                        <div>{{ $user->name }}</div>
                        <div>{{ $user->email }}</div>
                    </td>
                    <td>{{ $user->no_hp ?? '-' }}</td>
                    <td>{{ $user->alamat ?? '-' }}</td>
                    <td>{{ $user->total_sewa ?? 0 }} Kali sewa</td>
                    <td>
                        <a href="{{ route('admin.kelola_user.show', $user->id) }}">Lihat</a>
                        <a href="{{ route('admin.kelola_user.edit', $user->id) }}">Edit</a>
                        <form action="{{ route('admin.kelola_user.destroy', $user->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
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

    <div>
        <p>
            Menampilkan {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }}
            dari {{ $users->total() }} entri
        </p>
        {{ $users->links() }}
    </div>

@endsection
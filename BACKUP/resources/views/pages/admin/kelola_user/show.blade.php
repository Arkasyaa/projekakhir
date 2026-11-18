@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
    <div class="container py-4">
        <h1 class="page-title mb-3">Users detail</h1>

    <div>
        <img src="{{ asset('images/profile-default.png') }}" alt="Profil User" class="w-24 h-24 rounded-full object-cover">
    </div>

        <table class="table table-striped">
            <tr>
                <th width="200px">Nama</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th width="200px">Email</th>
                <td>{{ $user->email }}</td>
            </tr>
            <tr>
                <th width="200px">No Hp</th>
                <td>{{ $user->no_hp }}</td>
            </tr>
            <tr>
                <th width="200px">Alamat</th>
                <td>{{ $user->alamat }}</td>
            </tr>
            <tr>
                <th width="200px">Total Sewa</th>
                <td>{{ $user->total_sewa }}</td>
            </tr>
            <tr>
                <th width="200px">Terdaftar pada</th>
                <td>{{ \Carbon\Carbon::parse( $user->created_at )->isoFormat('DD MM Y H:m:s')}}</td>
            </tr>
            <tr>
                <th width="200px">Diperbarui pada</th>
                <td>{{ \Carbon\Carbon::parse($user->updated_at)->isoFormat('DD MM Y H:m:s')}}</td>
            </tr>
        </table>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.kelola_user.edit', $user->id ) }}" class="btn btn-primary">Edit User</a>
            <a href="{{ route('admin.kelola_user.index') }}" class="btn btn-secondary">Kembali Ke Daftar User</a>
        </div>
    </div>
@endsection

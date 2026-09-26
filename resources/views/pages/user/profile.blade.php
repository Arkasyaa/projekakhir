@extends('layouts.app')

@section('title', 'Kelola Alat')

@section('content')
<div class="bg-[#FCFBF6]">
    <div class="max-w-6xl mx-auto px-4 lg:px-10 py-20">
        <h1 class="font-['Outfit'] text-[30px] font-bold py-[30px]">Akun Saya</h1>
        <div class="flex gap-6 items-start">
            <div class="card bg-base-100 rounded-[24px] items-center" style="width: 400px;">
                <div class="card-body items-center text-center w-full py-9 px-6">
                    <div class="w-full flex justify-center">
                        <div class="w-32 h-32 rounded-full border-[3px] bg-emerald-800 flex items-center justify-center mb-6 shadow-lg">
                            <i class="fa-solid fa-user text-white text-5xl"></i>
                        </div>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" class="w-full flex flex-col items-center">
                        @csrf
                        @method('PUT')
                        <input
                            type="text"
                            name="name"
                            value="{{ $user->name }}"
                            class="bg-transparent text-center text-[24px] font-bold border-none focus:outline-none focus:ring-0 w-full p-0"
                        >
                        <input
                            type="email"
                            name="email"
                            value="{{ $user->email }}"
                            class="bg-transparent text-center text-[13px] opacity-60 border-none focus:outline-none focus:ring-0 w-full mt-1 p-0"
                        >
                    </form>
                    <hr class="mt-3">
                    <div class="w-full mt-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-3 rounded-xl bg-red-50 text-red-700/60 font-bold text-[15px] hover:bg-red-100 transition">
                                Keluar / Logout
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            <div>
                <div>
                    <div>
                        <div  class="card bg-base-100 rounded-[24px] px-20 py-20" style="width: 750px;">
                            <h2 class="text-left">Edit Akun</h2>
                            <p>Nama Lengkap</p>
                            <input type="text" name="name" value="{{ $user->name }}">
                            <label>Alamat</label>
                            <textarea name="address">{{ $user->address }}</textarea>
                        </div>
                    </div>

                        <button type="submit">
                            Simpan Perubahan
                        </button>
                </div> 
                <div>
                        <h2>Ubah Password</h2>

                        <form action="{{ route("profile.update") }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button type="submit">
                                Ubah Password
                            </button>
                            </form>

                                <div>
                                    <label>Password Lama</label>
                                    <input
                                        type="password"
                                        name="current_password"
                                    >
                                </div>

                                <div>
                                    <label>Password Baru</label>
                                    <input
                                        type="password"
                                        name="password"
                                    >
                                </div>

                                <div>
                                    <label>Konfirmasi Password Baru</label>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                    >
                                </div>

                                <button type="submit">
                                    Ubah Password
                                </button>
                            </form>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
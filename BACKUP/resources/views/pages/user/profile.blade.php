@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="bg-[#FCFBF6] min-h-screen">
    <div class="max-w-6xl mx-auto px-4 lg:px-10 py-12 lg:py-20">
        <h1 class="font-['Outfit'] text-3xl font-bold mb-8">Akun Saya</h1>

        @if (session('success'))
            <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-800" role="status">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-red-800" role="alert">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <div class="grid gap-6 lg:grid-cols-[320px_1fr] items-start">
            <aside class="card bg-base-100 rounded-3xl">
                <div class="card-body items-center text-center py-9 px-6">
                    <div class="w-full flex justify-center mb-4">
                        <div class="w-32 h-32 rounded-full bg-emerald-800 flex items-center justify-center shadow-lg">
                            <i class="fa-solid fa-user text-white text-5xl" aria-hidden="true"></i>
                        </div>
                    </div>
                    <p class="text-xl font-bold">{{ $user->name }}</p>
                    <p class="text-sm opacity-60">{{ $user->email }}</p>
                    <p class="mt-1 text-xs uppercase tracking-wide opacity-60">{{ $user->role }}</p>
                    <hr class="w-full my-3">
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" onclick="confirmLogout()" class="w-full py-3 rounded-xl bg-red-50 text-red-700 font-bold hover:bg-red-100 transition">
                            Keluar / Logout</button>
                    </form>
                </div>
            </aside>

            <div class="flex flex-col gap-6">
                <form action="{{ route('profile.update') }}" method="POST" class="card gap-4 bg-base-100 rounded-3xl p-6 lg:p-8">
                    @csrf
                    @method('PUT')
                    <h2 class="font-['Outfit'] font-bold text-xl">Edit Akun</h2>
                    <div class="flex flex-col gap-1">
                        <label for="name" class="font-semibold text-xs">Nama Lengkap</label>
                        <input id="name" class="border rounded-lg h-10 px-3 text-sm" type="text" name="name" value="{{ old('name', $user->name) }}" required maxlength="255">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="email" class="font-semibold text-xs">Alamat Email</label>
                        <input id="email" class="border rounded-lg h-10 px-3 text-sm" type="email" name="email" value="{{ old('email', $user->email) }}" required maxlength="255">
                    </div>
                    <button type="submit" class="rounded-lg text-sm text-white font-bold bg-[#D96B27] w-fit px-4 py-2">Simpan Perubahan</button>
                </form>

                <form action="{{ route('profile.password.update') }}" method="POST" class="card gap-4 bg-base-100 rounded-3xl p-6 lg:p-8">
                    @csrf
                    @method('PUT')
                    <h2 class="font-['Outfit'] font-bold text-xl">Ubah Password</h2>
                    <div class="flex flex-col gap-1">
                        <label for="current_password" class="font-semibold text-xs">Password Lama</label>
                        <div class="relative">
                            <input id="current_password" class="border rounded-lg h-10 px-3 pr-10 text-sm w-full" type="password" name="current_password" required autocomplete="current-password">
                            <button type="button" onclick="togglePassword('current_password', this)" class="absolute right-3 bottom-2 text-gray-500"><i class="fa-solid fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="password" class="font-semibold text-xs">Password Baru</label>
                        <div class="relative">
                            <input id="password" class="border rounded-lg h-10 px-3 pr-10 text-sm w-full" type="password" name="password" required minlength="8" autocomplete="new-password">
                            <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 bottom-2 text-gray-500"><i class="fa-solid fa-eye"></i></button>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="password_confirmation" class="font-semibold text-xs">Konfirmasi Password Baru</label>
                        <div class="relative">
                            <input id="password_confirmation" class="border rounded-lg h-10 px-3 pr-10 text-sm w-full" type="password" name="password_confirmation" required minlength="8" autocomplete="new-password">
                            <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-3 bottom-2 text-gray-500"><i class="fa-solid fa-eye"></i></button>
                        </div>
                    </div>
                    <button type="submit" class="rounded-lg text-sm text-white font-bold bg-[#285A4D] w-fit px-4 py-2">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>

<script>
    function confirmLogout() {
        if (!confirm('Apakah Anda yakin ingin keluar?')) {
            event.preventDefault();
        }
    }
</script>
@endsection

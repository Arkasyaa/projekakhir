<div class="profile-container">

    <h1>Profil Saya</h1>

    <section class="info-profile">

        <h2>Informasi Profil</h2>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label>Nama Lengkap</label>
                <input
                    type="text"
                    name="name"
                    value="{{ $user->name }}"
                >
            </div>

            <div>
                <label>Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ $user->email }}"
                >
            </div>

            <div>
                <label>Alamat</label>
                <textarea name="address">{{ $user->address }}</textarea>
            </div>

            <button type="submit">
                Simpan Perubahan
            </button>
        </form>
    </section>

    <section class="ubah-password">

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

            <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
            </form>
        </form>
    </section>
</div>

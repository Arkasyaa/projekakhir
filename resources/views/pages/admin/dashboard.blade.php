
<div class="container">
    <h1>Dashboard Admin</h1>
    <p>Halo {{ Auth::user()->name }}! Selamat datang 🎉</p>
    <p>Role kamu: {{ Auth::user()->role }} bangett</p>
    <hr>
    <a href="{{ route('logout') }}" 
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

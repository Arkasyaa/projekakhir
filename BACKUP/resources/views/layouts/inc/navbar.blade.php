<header class="fixed inset-x-0 top-0 z-50 transition-all duration-300 bg-white/80 dark:bg-zinc-950/80 backdrop-blur-md shadow-sm shadow-black/5">
  <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between" aria-label="Main navigation">

    <a class="font-['DM_Serif_Display'] font-bold text-xl tracking-tight relative z-10">
      <span class="text-[#285A4D] text-[20px] font-normal tracking-[1px] " >ZansOutdoor.</span>
    </a>

    <ul class="hidden md:flex items-center gap-8 text-sm" role="list">
      <li><a href="{{ route('home') }}#home" class="font-['Instrument_Sans'] nav-link">Home</a></li>
      <li><a href="{{ route('home') }}#katalog" class="font-['Instrument_Sans'] nav-link">Katalog</a></li>
      <li><a href="{{ route('home') }}#keunggulan" class="font-['Instrument_Sans'] nav-link">Keunggulan</a></li>
      <li><a href="{{ route('home') }}#cara_sewa" class="font-['Instrument_Sans'] nav-link">Cara Sewa</a></li>
      <li><a href="{{ route('home') }}#tentang_kami" class="font-['Instrument_Sans'] nav-link">Tentang Kami</a></li>
    </ul>

    <div class="flex items-center gap-3">
      <!-- Tombol Daftar -->
        <a href="{{ route('register') }}" class="shimmer bg-white/70 backdrop-blur-md text-emerald-800 text-sm font-medium px-5 py-2 rounded-full border border-emerald-800/30 hover:bg-white/90">
        Daftar
        </a>

      <!-- Tombol Login -->
        <a href="{{ route('login') }}" class="shimmer bg-emerald-800 text-white text-sm font-medium px-5 py-2 rounded-full hover:bg-emerald/90">
         Login
        </a>
    </div>
  </nav>
</header>

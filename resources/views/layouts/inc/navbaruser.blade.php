<header class="fixed inset-x-0 top-0 z-50 transition-all duration-300 bg-white/80 dark:bg-zinc-950/80 backdrop-blur-md shadow-sm shadow-black/5">
  <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between" aria-label="Main navigation">

    {{-- LOGO --}}
    <a href="{{ route('home') }}" class="font-['DM_Serif_Display'] font-bold text-xl tracking-tight relative z-10">
      <span class="text-[#285A4D] text-[20px] font-normal tracking-[1px]">ZansOutdoor.</span>
    </a>

    <ul class="hidden md:flex items-center gap-8 text-sm" role="list">
      <li><a href="{{ route('home') }}#home" class="font-['Instrument_Sans'] nav-link">Home</a></li>
      <li><a href="{{ route('home') }}#katalog" class="font-['Instrument_Sans'] nav-link">Katalog</a></li>
      <li><a href="{{ route('home') }}#keunggulan" class="font-['Instrument_Sans'] nav-link">Keunggulan</a></li>
      <li><a href="{{ route('home') }}#cara_sewa" class="font-['Instrument_Sans'] nav-link">Cara Sewa</a></li>
      <li><a href="{{ route('home') }}#tentang_kami" class="font-['Instrument_Sans'] nav-link">Tentang Kami</a></li>
    </ul>

    <div class="flex items-center gap-3">
        <a href="{{ route('keranjang.index') }}" class="hover:text-[#285A4D]">
          <i class="fa-solid fa-cart-shopping"></i>
        </a>
        <a href="{{ route('riwayat.index') }}" class="hover:text-[#285A4D]">
          <i class="fa-solid fa-history"></i>
        </a>
        <a href="{{ route('profile') }}" class="hover:text-[#285A4D]">
          <i class="fa-solid fa-user"></i>
        </a>
    </div>
  </nav>
</header>

<header class="fixed inset-x-0 top-0 z-50 transition-all duration-300 bg-white/80 dark:bg-zinc-950/80 backdrop-blur-md shadow-sm shadow-black/5">
  <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between" aria-label="Main navigation">

    <a class="font-['DM_Serif_Display'] font-bold text-xl tracking-tight relative z-10">
      <i class="fa-solid fa-mountain-sun text-[18px] text-[#285A4D] mr-[5px]"></i><span class="text-[#285A4D] text-[20px] font-normal tracking-[1px] " >ZansOutdoor.</span><span class="text-[#D96B27] text-[10px] !font-['Instrument_Sans'] font-bold rounded-full bg-[#FEE2E2] py-[1px] px-[7px]">ADMIN</span>
    </a>

    <ul class="hidden md:flex items-center gap-8 text-sm" role="list">
      <li><a href="{{ route('admin.alat.index') }}" class="font-['Instrument_Sans'] nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white" :class="s==='services'?'on !text-zinc-900 dark:!text-white':''">Kelola Alat</a></li>
      <li><a href="{{ route('admin.kelola_rental.index')}}"   class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white" :class="s==='about'?'on !text-zinc-900 dark:!text-white':''">Kelola Rental</a></li>
      <li><a href="{{ route('admin.kelola_user.index') }}"     class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white" :class="s==='work'?'on !text-zinc-900 dark:!text-white':''">Kelola User</a></li>
    </ul>

    <div>
        <a href="{{ route('profile') }}">
        <i class="fa-solid fa-user"></i>
        </a>
    </div>
  </nav>
</header>

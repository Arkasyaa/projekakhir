<header class="fixed inset-x-0 top-0 z-50 transition-all duration-300 bg-white/80 dark:bg-zinc-950/80 backdrop-blur-md shadow-sm shadow-black/5">
  <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between" aria-label="Main navigation">

    <a class="font-['DM_Serif_Display'] font-bold text-xl tracking-tight relative z-10">
      <i class="fa-solid fa-mountain-sun text-[18px] text-[#285A4D] mr-[5px]"></i><span class="text-[#285A4D] text-[20px] font-normal tracking-[1px] " >ZansOutdoor.</span><span class="text-[#D96B27] text-[10px] !font-['Instrument_Sans'] font-bold rounded-full bg-[#FEE2E2] py-[1px] px-[7px]">ADMIN</span>
    </a>

    <ul class="hidden md:flex items-center gap-8 text-sm" role="list">
<<<<<<< HEAD
      <li><a href="#home" class="font-['Instrument_Sans'] nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white" :class="s==='services'?'on !text-zinc-900 dark:!text-white':''">Kelola Alat</a></li>
      <li><a href="{{ route('admin.kelola_rental.index')}}"   class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white" :class="s==='about'?'on !text-zinc-900 dark:!text-white':''">Kelola Rental</a></li>
      <li><a href="{{ route('admin.kelola_user.index') }}"     class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white" :class="s==='work'?'on !text-zinc-900 dark:!text-white':''">Kelola User</a></li>
=======
      <li><a href="{{ route('admin.alat.index') }}" class="font-['Instrument_Sans'] nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white" :class="s==='services'?'on !text-zinc-900 dark:!text-white':''">Kelola Alat</a></li>
      <li><a href="{{ route('admin.kelola_user.index') }}"     class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white" :class="s==='work'?'on !text-zinc-900 dark:!text-white':''">Kelola User</a></li>
      <li><a href="#"   class="nl text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white" :class="s==='about'?'on !text-zinc-900 dark:!text-white':''">Kelola Rental</a></li>
>>>>>>> ea06c2ae86e597a242fa10d0e3f5aca06462f018
    </ul>

    <div>
        <a href="{{ route('profile') }}">
        <i class="fa-solid fa-user"></i>
        </a>
    </div>
    </div>
  </nav>

  <!-- mobile menu -->
  <div x-show="mm" x-cloak
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
    class="md:hidden bg-white dark:bg-zinc-950 border-t border-zinc-100 dark:border-zinc-900">
    <ul class="flex flex-col px-6 py-5 gap-4 text-sm font-medium" role="list">
      <li><a href="#services" @click="mm=false" class="block text-zinc-700 dark:text-zinc-300 hover:text-accent transition-colors">Services</a></li>
      <li><a href="#work"    @click="mm=false" class="block text-zinc-700 dark:text-zinc-300 hover:text-accent transition-colors">Work</a></li>
      <li><a href="#about"   @click="mm=false" class="block text-zinc-700 dark:text-zinc-300 hover:text-accent transition-colors">About</a></li>
      <li><a href="#reviews" @click="mm=false" class="block text-zinc-700 dark:text-zinc-300 hover:text-accent transition-colors">Reviews</a></li>
      <li><a href="#blog"    @click="mm=false" class="block text-zinc-700 dark:text-zinc-300 hover:text-accent transition-colors">Blog</a></li>
      <li><a href="#contact" @click="mm=false" class="block text-zinc-700 dark:text-zinc-300 hover:text-accent transition-colors">Contact</a></li>
      <li class="pt-2 border-t border-zinc-100 dark:border-zinc-900">
        <a href="#contact" @click="mm=false" class="inline-flex shimmer bg-accent text-white font-medium text-sm px-5 py-2.5 rounded-full">Hire me →</a>
      </li>
    </ul>
  </div>
</header>

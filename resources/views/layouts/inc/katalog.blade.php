<section id="katalog" class="py-20 bg-zinc-50 dark:bg-zinc-900/40">
  <div class="max-w-6xl mx-auto px-6">
    <div class="mb-14 text-center">
      <p class="reveal inline-block bg-[#D96B27]/10 rounded-full py-1 px-3 text-[8px] text-['Instrument_Sans'] text-[#D96B27] font-bold tracking-[5%] mb-7">
      KATALOG SEWA KAMI
      </p>

      <h2 class="reveal d1 font-['Outfit'] text-center tracking-[0%] font-[800] text-[30px]">Peralatan Tangguh untuk Segala<br> Medan Ekstrem</h2>

      @guest
      <a href="{{ route('login') }}" onclick="alert('Silakan login terlebih dahulu untuk melihat koleksi!')" class="flex justify-end items-center gap-2 text-sm font-medium text-emerald-800 hover:gap-3 transition-all">
            Lihat Item Koleksi
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </a>
      @else
      <a href="#katalog-detail" class="flex justify-end items-center gap-2 text-sm font-medium text-emerald-800 hover:gap-3 transition-all">
            Lihat Item Koleksi
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
      </a>
      @endguest
    </div>
    <div class="grid md:grid-cols-3 gap-6">

    <!-- Artikel 1 -->
      <article class="reveal d3 group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 hover:border-emerald-800 overflow-hidden transition-all hover:shadow-lg">
        <div class="aspect-[4/3] overflow-hidden">
            <img src="{{ asset('images/jaket.png') }}" alt="Paket Pakaian" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <div class="p-6">
            <h3 class="font-display font-bold text-xl text-zinc-900 dark:text-white mb-2">Paket Pakaian</h3>
            <p class="text-sm font-semibold text-emerald-800 mb-3">Sewa mulai Rp13.000/2 hari</p>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed mb-4">Jaket, Celana, dan Sepatu untuk kenyamanan pada tubuh Anda.</p>

            @guest
            <a href="{{ route('login') }}" onclick="alert('Silakan login terlebih dahulu!')" class="inline-flex items-center gap-2 text-sm font-medium text-emerald-800 hover:gap-3 transition-all">
            Lihat Item Koleksi <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            @else
            <a href="#katalog-detail" class="inline-flex items-center gap-2 text-sm font-medium text-emerald-800 hover:gap-3 transition-all">
            Lihat Item Koleksi <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            @endguest
        </div>
      </article>

    <!-- Artikel 2 -->
      <article class="reveal d3 group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 hover:border-emerald-800 overflow-hidden transition-all hover:shadow-lg">
        <div class="aspect-[4/3] overflow-hidden">
            <img src="{{ asset('images/tenda.webp') }}" alt="Paket Pakaian" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <div class="p-6">
            <h3 class="font-display font-bold text-xl text-zinc-900 dark:text-white mb-2">Camp</h3>
            <p class="text-sm font-semibold text-emerald-800 mb-3">Sewa mulai Rp40.000/2 hari</p>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed mb-4">Tenda, Matras, dan Sleeping Bag berkualitas untuk kenyamanan saat Anda beristirahat.</p>

            @guest
            <a href="{{ route('login') }}" onclick="alert('Silakan login terlebih dahulu!')" class="inline-flex items-center gap-2 text-sm font-medium text-emerald-800 hover:gap-3 transition-all">
            Lihat Item Koleksi <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            @else
            <a href="#katalog-detail" class="inline-flex items-center gap-2 text-sm font-medium text-emerald-800 hover:gap-3 transition-all">
            Lihat Item Koleksi <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            @endguest
        </div>
      </article>

    <!-- Artikel 3 -->
       <article class="reveal d3 group bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-100 dark:border-zinc-800 hover:border-emerald-800 overflow-hidden transition-all hover:shadow-lg">
        <div class="aspect-[4/3] overflow-hidden">
            <img src="{{ asset('images/carrier.jpeg') }}" alt="Paket Pakaian" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        </div>
        <div class="p-6">
            <h3 class="font-display font-bold text-xl text-zinc-900 dark:text-white mb-2">Tas</h3>
            <p class="text-sm font-semibold text-emerald-800 mb-3">Sewa mulai Rp10.000/2 hari</p>
            <p class="text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed mb-4">Carrier, Hydropack, dan Daypack yang nyaman dan berkualitas saat Anda gunakan.</p>

            @guest
            <a href="{{ route('login') }}" onclick="alert('Silakan login terlebih dahulu!')" class="inline-flex items-center gap-2 text-sm font-medium text-emerald-800 hover:gap-3 transition-all">
            Lihat Item Koleksi <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            @else
            <a href="#katalog-detail" class="inline-flex items-center gap-2 text-sm font-medium text-emerald-800 hover:gap-3 transition-all">
            Lihat Item Koleksi <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            @endguest
        </div>
      </article>

    </div>
  </div>
</section>
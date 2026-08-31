<!DOCTYPE html>
<html lang="en" x-data="app()" :class="{'dark':dark}" class="scroll-smooth">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ZansOutdoor — Outdoor&amp; Rental</title>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Outfit:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital,wght@0,400;0,700;1,400&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500&display=swap" rel="stylesheet">



<script>
tailwind.config = {
  darkMode: 'class',
  theme: {
    extend: {
      fontFamily: { display: ['PT Sans','sans-serif'], body: ['DM Sans','sans-serif'] },
      colors: { accent: '#FF6B2B', 'accent-light': '#FF8F5C' }
    }
  }
}
</script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div>
 @include('layouts.inc.navbaruser')
</div>

<div class="bg-gray-50 py-20">
    <div class="container mx-auto px-4 lg:px-8">

        <!-- Breadcrumb -->
        <nav class="text-sm text-gray-500 mb-6">
            <a href="#" class="hover:text-emerald-700">Beranda</a>
            <span class="mx-2">></span>
            <a href="#" class="hover:text-emerald-700">Katalog</a>
            <span class="mx-2">></span>
            <span class="text-[#B86B4B] font-medium">Detail Katalog</span> 
        </nav>
         <div class="flex items-center gap-3 mb-2">
            <a href="#" class="text-2xl">
                <i class="fa-solid fa-arrow-left"></i> 
            </a>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Detail Katalog</h1>
        </div>
        <p class="text-gray-600 mb-8">
            Pilih dan sesuaikan perlengkapan hiking & camping terbaik untuk ekspedisi tangguh Anda.
        </p>
         <div class="flex flex-wrap gap-3">
            <button class="px-6 py-2 rounded-full bg-gray-900 text-white font-medium hover:bg-gray-800 transition">Semua</button>
            <button class="px-6 py-2 rounded-full bg-white text-gray-700 border-gray-200 font-medium hover:bg-gray-100 transition">Pakaian</button>
            <button class="px-6 py-2 rounded-full bg-white text-gray-700 border-gray-200 font-medium hover:bg-gray-100 transition">Tas Carrier & Pack</button>
            <button class="px-6 py-2 rounded-full bg-white text-gray-700 border-gray-200 font-medium hover:bg-gray-100 transition">Camping</button>
            <button class="px-6 py-2 rounded-full bg-white text-gray-700 border-gray-200 font-medium hover:bg-gray-100 transition">Aksesoris Hiking</button>
        </div>
        
        <div class="container mx-auto pt-10 pb-4">
            <div class="flex items-center gap-3">
                <div class="w-1 h-8 bg-[#B86B4B] rounded-full"></div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Pakaian Outdoor</h2>
            </div>
            {{-- ini kategori pakaian ck--}}
        </div>
         

    </div>
</div>



<script>
function app() {
  return {
    mm: false,
    sc: false,
    s: 'hero',

    init() {

      // scroll
      window.addEventListener('scroll', () => {
        this.sc = window.scrollY > 20;
        this.updateSection();
      }, { passive: true });

      // reveal
      const io = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
      }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
      document.querySelectorAll('.reveal').forEach(el => io.observe(el));

      // year
      document.getElementById('yr').textContent = new Date().getFullYear();
    },

    updateSection() {
      const atBottom = (window.innerHeight + window.scrollY) >= document.body.scrollHeight - 60;
      if (atBottom) { this.s = 'contact'; return; }
      const ids = ['contact','blog','reviews','about','work','services','hero'];
      for (const id of ids) {
        const el = document.getElementById(id);
        if (el && window.scrollY >= el.offsetTop - 130) { this.s = id; return; }
      }
    }
  }
}
</script>

</body>
</html>

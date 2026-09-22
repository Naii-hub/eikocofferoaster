<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EIKO COFFEE ROASTER')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { red: '#DC2626', dark: '#0B111A', navy: '#131B26' },
                        coffee: { 50: '#fdf8f0', 100: '#f9edd9', 500: '#db7f2e', 600: '#cd6624', 700: '#ab4d1f', 800: '#8a3e20' }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Oswald"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased min-h-screen flex flex-col lg:flex-row bg-white">
    <div class="relative lg:w-1/2 min-h-[38vh] lg:min-h-screen flex flex-col justify-between overflow-hidden">
        <img alt="Industrial Coffee Roasting Machine in Workshop" src="{{ asset('images/bg.png') }}"
            class="absolute inset-0 w-full h-full object-cover object-center" />
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-brand-dark/60 to-black/30"></div>
        <div class="absolute -left-24 -top-24 w-72 h-72 rounded-full bg-red-600/30 blur-3xl"></div>
        <div class="relative z-10 p-8 lg:p-12">
            <div class="inline-flex items-center gap-3">
                <img alt="EIKO Logo" src="{{ asset('images/logo_eiko.png') }}" class="h-12 w-auto invert" />
                <span class="font-display uppercase tracking-widest text-white font-bold text-lg">EIKO Coffee Roaster</span>
            </div>
        </div>
        <div class="relative z-10 p-8 lg:p-12">
            <h1 class="font-display text-3xl lg:text-4xl font-bold text-white uppercase leading-tight max-w-sm">Mesin Sangrai Kopi Premium Buatan Indonesia</h1>
            <ul class="mt-6 space-y-3 text-sm text-white/85">
                <li class="flex items-center gap-3"><i class="fa-solid fa-circle-check text-red-500"></i> Durabilitas industri & presisi tinggi</li>
                <li class="flex items-center gap-3"><i class="fa-solid fa-circle-check text-red-500"></i> Profiling kopi specialty level kompetisi</li>
                <li class="flex items-center gap-3"><i class="fa-solid fa-circle-check text-red-500"></i> Dukungan training & garansi resmi</li>
            </ul>
        </div>
    </div>
    <div class="flex-1 lg:w-1/2 flex items-center justify-center p-6 sm:p-10 bg-coffee-50">
        <div class="w-full max-w-md">
            <a href="{{ url('/') }}"
                class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-brand-red transition-colors mb-8">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Beranda
            </a>
            <div class="lg:hidden text-center">
                <img alt="EIKO Logo" src="{{ asset('images/logo_eiko.png') }}" class="h-14 w-auto mx-auto mb-8" />
            </div>
            @yield('form')
        </div>
    </div>
</body>
</html>
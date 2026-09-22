<!DOCTYPE html>
<html class="scroll-smooth" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ __('messages.page_title') }}</title>
    <!-- Tailwind CSS v3 with Plugins -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <!-- FontAwesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&amp;family=Plus+Jakarta+Sans:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <!-- Tailwind Custom Config -->
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            red: '#DC2626',
                            redHover: '#B91C1C',
                            dark: '#0B111A',
                            navy: '#131B26',
                            slate: '#1E293B',
                            steel: '#334155',
                            grayLight: '#F1F5F9'
                        }
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        display: ['"Oswald"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Custom Styles: Typography & Atmosphere -->
    <style data-purpose="typography">
        .font-condensed {
            font-family: 'Oswald', sans-serif;
            letter-spacing: -0.01em;
        }

        .text-shadow-sm {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        html:not(.dark) .text-shadow-sm {
            text-shadow: none;
        }

        .text-shadow-lg {
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        html:not(.dark) .text-shadow-lg {
            text-shadow: none;
        }
    </style>
    <!-- Custom Styles: Layout & Interactive Carousel -->
    <style data-purpose="carousel-and-fx">
        .carousel-container::-webkit-scrollbar {
            display: none;
        }

        .carousel-container {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .roaster-card {
            transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        }

        #roasterCarousel .roaster-card:hover {
            border-color: #DC2626;
            box-shadow: 0 18px 40px -14px rgba(220, 38, 38, 0.4);
            transform: translateY(-6px);
        }

        .carousel-bullet {
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        .carousel-bullet.active {
            width: 2rem;
            background-color: #DC2626;
        }

        .hero-gradient-overlay {
            background: linear-gradient(90deg, rgba(8, 14, 23, 0.665) 0%, rgba(13, 22, 36, 0.619) 48%, rgba(11, 20, 34, 0.291) 100%);
        }

        .hero-bottom-fade {
            background: linear-gradient(180deg, rgba(11, 17, 26, 0) 0%, rgba(11, 17, 26, 0.85) 85%, #0B111A 100%);
        }

        /* Light mode hero gradient override */
        html:not(.dark) .hero-gradient-overlay {
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.335) 0%, rgba(249, 250, 251, 0.552) 48%, rgba(249, 250, 251, 0.23) 100%);
        }

        html:not(.dark) .hero-bottom-fade {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0) 0%, rgba(249, 250, 251, 0.356) 85%, #f9fafb82 100%);
        }
    </style>
</head>

<body
    class="bg-gray-50 text-slate-900 dark:bg-brand-dark dark:text-slate-100 font-sans antialiased overflow-x-hidden transition-colors duration-300">
    <!-- BEGIN: HeaderAndNavigation -->
    <header
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 backdrop-blur-md bg-white/85 dark:bg-brand-dark/85 border-b border-gray-200 dark:border-slate-800/80">
        <nav aria-label="Main Navigation"
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <div class="flex items-center gap-3">
                <a class="flex items-center gap-2 group" href="#">
                    <img src="{{ asset('images/logo_eiko.png') }}" alt="" class="p-1 w-auto h-12 dark:invert">
                </a>
            </div>
            <!-- Navigation Menu -->
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600 dark:text-slate-300">
                <a class="text-slate-900 dark:text-white hover:text-red-600 dark:hover:text-red-500 transition-colors py-1 relative after:absolute after:bottom-0 after:left-0 after:right-0 after:h-0.5 after:bg-red-600"
                    href="#hero">{{ __('messages.nav.home') }}</a>
                <a class="hover:text-slate-900 dark:hover:text-white transition-colors py-1"
                    href="#about">{{ __('messages.nav.about') }}</a>
                <a class="hover:text-slate-900 dark:hover:text-white transition-colors py-1"
                    href="#products">{{ __('messages.nav.product') }}</a>
                <a class="hover:text-slate-900 dark:hover:text-white transition-colors py-1"
                    href="#services">{{ __('messages.nav.services') }}</a>
                <a class="hover:text-slate-900 dark:hover:text-white transition-colors py-1"
                    href="#contact">{{ __('messages.nav.contact') }}</a>
            </div>
            <!-- Utility & Language -->
            <div class="flex items-center gap-4">
                <a class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition-colors"
                    href="{{ route('login') }}">{{ __('messages.nav.sign_in') }}</a>
                <div class="relative" id="langSwitcher">
                    <button
                        class="flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded-full border border-gray-300 dark:border-slate-700 bg-gray-100 dark:bg-slate-800/60 text-slate-700 dark:text-slate-200 hover:border-red-500 transition-colors"
                        id="langBtn" title="{{ __('messages.nav.change_language') }}" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fa-solid fa-globe text-red-500 text-sm"></i>
                        <span>{{ app()->getLocale() === 'en' ? 'Eng' : 'Ind' }}</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-slate-400"></i>
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-48 rounded-lg border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-xl hidden overflow-hidden"
                        id="langMenu" role="menu">
                        <a href="{{ route('language', 'id') }}"
                            class="flex items-center gap-2 px-3 py-2.5 text-xs font-medium text-slate-700 dark:text-slate-200 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors {{ app()->getLocale() === 'id' ? 'text-red-600 dark:text-red-500 font-bold' : '' }}">
                            <span class="text-sm">🇮🇩</span>
                            <span class="flex-1">{{ __('messages.nav.lang_ind') }}</span>
                            @if (app()->getLocale() === 'id')
                                <i class="fa-solid fa-check text-red-500 text-xs"></i>
                            @endif
                        </a>
                        <a href="{{ route('language', 'en') }}"
                            class="flex items-center gap-2 px-3 py-2.5 text-xs font-medium text-slate-700 dark:text-slate-200 hover:bg-gray-100 dark:hover:bg-slate-700 transition-colors {{ app()->getLocale() === 'en' ? 'text-red-600 dark:text-red-500 font-bold' : '' }}">
                            <span class="text-sm">🇬🇧</span>
                            <span class="flex-1">{{ __('messages.nav.lang_en') }}</span>
                            @if (app()->getLocale() === 'en')
                                <i class="fa-solid fa-check text-red-500 text-xs"></i>
                            @endif
                        </a>
                    </div>
                </div>
                <!-- Theme Toggle Button -->
                <button id="themeToggle"
                    class="flex items-center gap-1.5 text-xs font-semibold px-2.5 py-1.5 rounded-full border border-gray-300 dark:border-slate-700 bg-gray-100 dark:bg-slate-800/60 text-slate-700 dark:text-slate-200 hover:border-red-500 transition-colors"
                    title="{{ __('messages.nav.change_theme') }}">
                    <i class="fa-solid fa-moon text-indigo-500 dark:hidden text-sm"></i>
                    <i class="fa-solid fa-sun text-yellow-500 hidden dark:block text-sm"></i>
                    <span class="dark:hidden">{{ __('messages.nav.theme_dark') }}</span>
                    <span class="hidden dark:block">{{ __('messages.nav.theme_light') }}</span>
                </button>
                <!-- Mobile hamburger toggle button -->
                <button aria-label="Open Menu"
                    class="md:hidden text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white text-xl p-1 focus:outline-none"
                    id="mobileMenuBtn">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </nav>
    </header>
    <!-- END: HeaderAndNavigation -->

    <!-- BEGIN: HeroSection -->
    <section
        class="relative min-h-[720px] lg:min-h-[820px] flex items-center pt-24 pb-16 bg-gray-100 dark:bg-slate-950 overflow-hidden"
        id="hero">
        <!-- Hero Background Image With Coffee Roaster Machine -->
        <div class="absolute inset-0 z-0">
            <img alt="Industrial Coffee Roasting Machine Drum and Cooling Tray in Workshop"
                class="w-full h-full object-cover object-right md:object-center filter brightness-90 dark:brightness-65 contrast-110"
                src="{{ asset('images/bg.png') }}" />
            <!-- Dramatic Atmospheric Gradient Overlays -->
            <div class="absolute inset-0 hero-gradient-overlay"></div>
            <div class="absolute inset-0 hero-bottom-fade"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="max-w-2xl lg:max-w-3xl">
                <!-- Red Pill Badge -->
                <div
                    class="inline-flex items-center gap-2 px-4 py-1.5 mb-6 rounded-md bg-red-600 text-white font-bold text-xs tracking-wider uppercase shadow-md shadow-red-600/30">
                    <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
                    <span>{{ __('messages.hero.badge') }}</span>
                </div>
                <!-- Main Headline -->
                <h1
                    class="font-condensed text-5xl sm:text-6xl md:text-7xl lg:text-[5rem] font-bold text-slate-900 dark:text-white uppercase leading-[0.95] tracking-tight mb-5 text-shadow-lg">
                    {{ __('messages.hero.title_part1') }} <span class="text-red-600">{{ __('messages.hero.title_part2') }}</span>
                    {{ __('messages.hero.title_part3') }} <span
                        class="text-red-600">{{ __('messages.hero.title_part4') }}</span>
                </h1>
                <!-- Subtitle with Red Accent Bar -->
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-1.5 h-6 bg-red-600 rounded-full inline-block"></span>
                    <p class="text-lg md:text-xl font-semibold text-slate-700 dark:text-slate-200 tracking-wide">
                        {{ __('messages.hero.subtitle') }}
                    </p>
                </div>
                <!-- Paragraph Description -->
                <p
                    class="text-slate-600 dark:text-slate-300 text-sm md:text-base leading-relaxed mb-8 max-w-xl text-shadow-sm font-normal">
                    {{ __('messages.hero.description') }}
                </p>
                <!-- CTA Buttons -->
                <div class="flex flex-wrap items-center gap-4">
                    <a class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold text-sm transition-all shadow-lg shadow-red-600/40 hover:shadow-red-600/60 transform hover:-translate-y-0.5"
                        href="#products">
                        <i class="fa-solid fa-book-open text-base"></i>
                        <span>{{ __('messages.hero.cta_catalog') }}</span>
                    </a>
                    <a class="inline-flex items-center gap-2.5 px-6 py-3.5 rounded-lg border border-gray-400 dark:border-slate-500/80 bg-white/60 dark:bg-slate-900/60 hover:bg-gray-100 dark:hover:bg-slate-800/90 text-slate-900 dark:text-white font-medium text-sm transition-all backdrop-blur-sm hover:border-slate-400 dark:hover:border-slate-300 transform hover:-translate-y-0.5"
                        href="https://wa.me/6281234567890" target="_blank">
                        <i class="fa-solid fa-phone text-sm text-red-500"></i>
                        <span>{{ __('messages.hero.cta_contact') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- END: HeroSection -->

    <!-- BEGIN: ProductShowcaseCarousel -->
    <section
        class="py-20 bg-gray-100 dark:bg-brand-navy border-t border-b border-gray-200 dark:border-slate-800/80 relative"
        id="products">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 pb-4">
                <div>
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded bg-gray-200 dark:bg-slate-800 text-red-600 dark:text-red-400 font-bold text-xs uppercase tracking-wider mb-2 border border-gray-300 dark:border-slate-700">
                        <i class="fa-solid fa-award"></i> {{ __('messages.products.badge') }}
                    </div>
                    <h2
                        class="font-condensed text-3xl md:text-4xl lg:text-5xl font-bold uppercase text-slate-900 dark:text-white tracking-tight">
                        {{ __('messages.products.title') }} <span class="text-red-500">{{ __('messages.products.title_red') }}</span>
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm md:text-base mt-1 max-w-2xl">
                        {{ __('messages.products.description') }}
                    </p>
                </div>
                <!-- Navigation Buttons -->
                <div class="flex items-center gap-3 mt-6 md:mt-0">
                    <button aria-label="{{ __('messages.products.prev') }}"
                        class="w-12 h-12 rounded-full border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800/90 text-slate-700 dark:text-white hover:bg-red-600 hover:text-white dark:hover:bg-red-600 dark:hover:text-white hover:border-red-600 transition-all flex items-center justify-center shadow-lg active:scale-95"
                        id="carouselPrevBtn">
                        <i class="fa-solid fa-chevron-left text-base"></i>
                    </button>
                    <button aria-label="{{ __('messages.products.next') }}"
                        class="w-12 h-12 rounded-full border border-gray-300 dark:border-slate-700 bg-white dark:bg-slate-800/90 text-slate-700 dark:text-white hover:bg-red-600 hover:text-white dark:hover:bg-red-600 dark:hover:text-white hover:border-red-600 transition-all flex items-center justify-center shadow-lg active:scale-95"
                        id="carouselNextBtn">
                        <i class="fa-solid fa-chevron-right text-base"></i>
                    </button>
                </div>
            </div>
            <!-- Carousel Cards Container -->
            <div class="carousel-container flex gap-6 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-6 pt-2"
                id="roasterCarousel">
                <!-- Card 1 -->
                <div data-index="0"
                    class="roaster-card snap-start shrink-0 w-[280px] sm:w-[320px] rounded-xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex flex-col group overflow-hidden shadow-xl">
                    <div
                        class="relative h-56 bg-gray-100 dark:bg-slate-800 overflow-hidden flex items-center justify-center p-4">
                        <img alt="Eiko Nano Sample Roaster"
                            class="w-full h-full object-cover rounded-md group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuDp6JpYYvagPY2hvlvlvtxh308ht2z4B1L69Vfx55olTMVRjazO8XRDt7S7kvR--AkSP7klA5L_4psf-neLyoXRfcxOrD6PJZLSR8Hhr-im9aH_9BFjNPex0Y-__RWV9D4cJZfjEUJ0FYWVVT34tYZyBLNsLjIkA9g_KOvC4zUSKkAmojlwVAtFjRr2VxZQvpPImOqIBIj0ty2SnJ4-CB-E5iml47n33P1AHQuTNRZVb4TibrNx_d5P" />
                        <span
                            class="card-capacity absolute top-3 right-3 bg-red-600 text-white text-[11px] font-bold px-2.5 py-1 rounded shadow">100g
                            - 250g</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between bg-white dark:bg-slate-900">
                        <div>
                            <p class="card-category text-xs font-semibold text-red-600 dark:text-red-500 uppercase tracking-wider">
                                {{ __('messages.products.nano.category') }}</p>
                            <h3
                                class="card-title font-condensed text-2xl font-bold text-slate-900 dark:text-white uppercase mt-1">
                                {{ __('messages.products.nano.name') }}</h3>
                            <p class="card-desc text-xs text-slate-500 dark:text-slate-400 mt-2 line-clamp-2">{{ __('messages.products.nano.desc') }}</p>
                            <ul class="mt-4 space-y-1.5 text-xs text-slate-600 dark:text-slate-300">
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.nano.feature1') }}</li>
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.nano.feature2') }}</li>
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.nano.feature3') }}</li>
                            </ul>
                        </div>
                        <div
                            class="mt-6 pt-4 border-t border-gray-200 dark:border-slate-800 flex items-center justify-between">
                            <span class="card-status text-xs text-slate-500 dark:text-slate-400">{{ __('messages.products.ready_to_ship') }}</span>
                            <button type="button"
                                class="open-detail text-xs font-bold text-slate-900 dark:text-white hover:text-red-600 dark:hover:text-red-400 flex items-center gap-1 group-hover:underline">{{ __('messages.products.unit_details') }}
                                <i class="fa-solid fa-arrow-right text-[10px]"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div data-index="1"
                    class="roaster-card snap-start shrink-0 w-[280px] sm:w-[320px] rounded-xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex flex-col group overflow-hidden shadow-xl relative">
                    <div
                        class="card-badge absolute top-2 left-2 z-10 bg-red-600 text-white text-[10px] font-black uppercase tracking-widest px-2.5 py-0.5 rounded shadow">
                        {{ __('messages.products.best_seller') }}</div>
                    <div
                        class="relative h-56 bg-gray-100 dark:bg-slate-800 overflow-hidden flex items-center justify-center p-4">
                        <img alt="Eiko Artisan Pro 1.2 kg Roaster"
                            class="w-full h-full object-cover rounded-md group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuB13MhKQPPZLdubUd9eSBALgotWbs7VKM4pro4al7Vjto6DzWouuFZTdeohZGZ-QqhdtSuiNrLdjaRMqpod5fCOYBLSn_lo3NVioHsmGpJzC-2Bs4kFY9gnUQqgbKDk-2inxEvBNcDXufrzBeT7nGAi5mbF1B9mr6pMxdGUtgA1avi9LlhaFsWU9jONmdQhJ9mmgBXOEyPCjfNzAldMBETDHPeT4xfSMnmC7cHeSZIZ5nWlvS7IxW9l" />
                        <span
                            class="card-capacity absolute top-3 right-3 bg-gray-900/80 dark:bg-slate-950/80 text-white text-[11px] font-bold px-2.5 py-1 rounded border border-gray-300 dark:border-slate-700 shadow">1.0kg
                            - 1.2kg</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between bg-white dark:bg-slate-900">
                        <div>
                            <p class="card-category text-xs font-semibold text-red-600 dark:text-red-500 uppercase tracking-wider">
                                {{ __('messages.products.pro.category') }}</p>
                            <h3
                                class="card-title font-condensed text-2xl font-bold text-slate-900 dark:text-white uppercase mt-1">
                                {{ __('messages.products.pro.name') }}</h3>
                            <p class="card-desc text-xs text-slate-500 dark:text-slate-400 mt-2 line-clamp-2">{{ __('messages.products.pro.desc') }}</p>
                            <ul class="mt-4 space-y-1.5 text-xs text-slate-600 dark:text-slate-300">
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.pro.feature1') }}</li>
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.pro.feature2') }}</li>
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.pro.feature3') }}</li>
                            </ul>
                        </div>
                        <div
                            class="mt-6 pt-4 border-t border-gray-200 dark:border-slate-800 flex items-center justify-between">
                            <span class="card-status text-xs text-green-600 dark:text-green-400 font-medium">{{ __('messages.products.warranty') }}</span>
                            <button type="button"
                                class="open-detail text-xs font-bold text-slate-900 dark:text-white hover:text-red-600 dark:hover:text-red-400 flex items-center gap-1 group-hover:underline">{{ __('messages.products.unit_details') }}
                                <i class="fa-solid fa-arrow-right text-[10px]"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div data-index="2"
                    class="roaster-card snap-start shrink-0 w-[280px] sm:w-[320px] rounded-xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex flex-col group overflow-hidden shadow-xl">
                    <div
                        class="relative h-56 bg-gray-100 dark:bg-slate-800 overflow-hidden flex items-center justify-center p-4">
                        <img alt="Eiko Commercial 3-5kg Roaster"
                            class="w-full h-full object-cover rounded-md group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAGMSP1-FUcZhS3Rf6vat8zHk0NtbuCnDqkbYzuB898sAyujc6eF27DXuWzPijg3ZkA6fP6zp8WL_wnhyJ_la_fV9Szz07JOtqW43oBPFOj9oC94OiHUjUgV0-R3ONVZn_qROMBEatVJpeCoHsgf9cvulYc8g7jVx-HwJBkApxxJqq0mBJxw3cfIWRrCR7_oVZc0gDFMelwZP0o2daomSTBJwc-ScrYROp5jaGUyechISDVpY6_vypC" />
                        <span
                            class="card-capacity absolute top-3 right-3 bg-red-600 text-white text-[11px] font-bold px-2.5 py-1 rounded shadow">3.0kg
                            - 5.0kg</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between bg-white dark:bg-slate-900">
                        <div>
                            <p class="card-category text-xs font-semibold text-red-600 dark:text-red-500 uppercase tracking-wider">
                                {{ __('messages.products.commercial.category') }}</p>
                            <h3
                                class="card-title font-condensed text-2xl font-bold text-slate-900 dark:text-white uppercase mt-1">
                                {{ __('messages.products.commercial.name') }}</h3>
                            <p class="card-desc text-xs text-slate-500 dark:text-slate-400 mt-2 line-clamp-2">{{ __('messages.products.commercial.desc') }}</p>
                            <ul class="mt-4 space-y-1.5 text-xs text-slate-600 dark:text-slate-300">
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.commercial.feature1') }}</li>
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.commercial.feature2') }}</li>
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.commercial.feature3') }}</li>
                            </ul>
                        </div>
                        <div
                            class="mt-6 pt-4 border-t border-gray-200 dark:border-slate-800 flex items-center justify-between">
                            <span class="card-status text-xs text-slate-500 dark:text-slate-400">{{ __('messages.products.fuel_efficiency') }}</span>
                            <button type="button"
                                class="open-detail text-xs font-bold text-slate-900 dark:text-white hover:text-red-600 dark:hover:text-red-400 flex items-center gap-1 group-hover:underline">{{ __('messages.products.unit_details') }}
                                <i class="fa-solid fa-arrow-right text-[10px]"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Card 4 -->
                <div data-index="3"
                    class="roaster-card snap-start shrink-0 w-[280px] sm:w-[320px] rounded-xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex flex-col group overflow-hidden shadow-xl">
                    <div
                        class="relative h-56 bg-gray-100 dark:bg-slate-800 overflow-hidden flex items-center justify-center p-4">
                        <img alt="Eiko Industrial 12kg"
                            class="w-full h-full object-cover rounded-md group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuABxt-GfHCA1H1ZnpnWSZuERdbyLQlY6OPC2_7PlnphGzsI4Y_lOK6GSSClFfhLwaOMC9Z2-NGV6io5DxM27C8d-LtzNFkyUhPK0BsEo3QCen6A4MXazNfRwgJ9NQSwjNHx6qej2fV9kY4ajvVQXJncjhtb3WlcnMl3EgCo-fHA9tFuMFl25JCKf20K0ndXJjwZbnGInMn_AZrhTyKdyoYSPSnRwJYEUtiTHHiGrNzpki1I_h9NGlx6" />
                        <span
                            class="card-capacity absolute top-3 right-3 bg-red-600 text-white text-[11px] font-bold px-2.5 py-1 rounded shadow">10kg
                            - 15kg</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between bg-white dark:bg-slate-900">
                        <div>
                            <p class="card-category text-xs font-semibold text-red-600 dark:text-red-500 uppercase tracking-wider">
                                {{ __('messages.products.master.category') }}</p>
                            <h3
                                class="card-title font-condensed text-2xl font-bold text-slate-900 dark:text-white uppercase mt-1">
                                {{ __('messages.products.master.name') }}</h3>
                            <p class="card-desc text-xs text-slate-500 dark:text-slate-400 mt-2 line-clamp-2">{{ __('messages.products.master.desc') }}</p>
                            <ul class="mt-4 space-y-1.5 text-xs text-slate-600 dark:text-slate-300">
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.master.feature1') }}</li>
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.master.feature2') }}</li>
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.master.feature3') }}</li>
                            </ul>
                        </div>
                        <div
                            class="mt-6 pt-4 border-t border-gray-200 dark:border-slate-800 flex items-center justify-between">
                            <span class="card-status text-xs text-slate-500 dark:text-slate-400">{{ __('messages.products.on_site_support') }}</span>
                            <button type="button"
                                class="open-detail text-xs font-bold text-slate-900 dark:text-white hover:text-red-600 dark:hover:text-red-400 flex items-center gap-1 group-hover:underline">{{ __('messages.products.unit_details') }}
                                <i class="fa-solid fa-arrow-right text-[10px]"></i></button>
                        </div>
                    </div>
                </div>
                <!-- Card 5 -->
                <div data-index="4"
                    class="roaster-card snap-start shrink-0 w-[280px] sm:w-[320px] rounded-xl bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex flex-col group overflow-hidden shadow-xl">
                    <div
                        class="relative h-56 bg-gray-100 dark:bg-slate-800 overflow-hidden flex items-center justify-center p-4">
                        <img alt="Eiko Industrial Plant 30kg+"
                            class="w-full h-full object-cover rounded-md group-hover:scale-105 transition-transform duration-500 filter brightness-90"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCj_OYNuyPpikqzE-HkHWmR_Y974xZi6htPZPAcVd8zIBlCQLdUaWvz5Q2kSnX9rpAT1StM40ftzULtAKqjX65vK3IDoFkqdzwLFU-uMXMpd5DpJPpr4mRB14OHZzYlJHB7iAxf23f_TnQ4E4HvlijJhXVmYA-xIW2pgnMuo4U7u-xJvPFoemop0vsqDowkQmsf6CJnf4roNHutzk1JmnLrBpEYeuAb2l9TX_kZTNSXhiXZ-5rOpIp0" />
                        <span
                            class="card-capacity absolute top-3 right-3 bg-red-600 text-white text-[11px] font-bold px-2.5 py-1 rounded shadow">30kg
                            - 60kg</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between bg-white dark:bg-slate-900">
                        <div>
                            <p class="card-category text-xs font-semibold text-red-600 dark:text-red-500 uppercase tracking-wider">
                                {{ __('messages.products.megaplant.category') }}</p>
                            <h3
                                class="card-title font-condensed text-2xl font-bold text-slate-900 dark:text-white uppercase mt-1">
                                {{ __('messages.products.megaplant.name') }}</h3>
                            <p class="card-desc text-xs text-slate-500 dark:text-slate-400 mt-2 line-clamp-2">{{ __('messages.products.megaplant.desc') }}</p>
                            <ul class="mt-4 space-y-1.5 text-xs text-slate-600 dark:text-slate-300">
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.megaplant.feature1') }}</li>
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.megaplant.feature2') }}</li>
                                <li class="card-feature flex items-center gap-2"><i
                                        class="fa-solid fa-check text-red-500 text-[10px]"></i> {{ __('messages.products.megaplant.feature3') }}</li>
                            </ul>
                        </div>
                        <div
                            class="mt-6 pt-4 border-t border-gray-200 dark:border-slate-800 flex items-center justify-between">
                            <span class="card-status text-xs text-slate-500 dark:text-slate-400">{{ __('messages.products.custom_engineering') }}</span>
                            <button type="button"
                                class="open-detail text-xs font-bold text-slate-900 dark:text-white hover:text-red-600 dark:hover:text-red-400 flex items-center gap-1 group-hover:underline">{{ __('messages.products.unit_details') }}
                                <i class="fa-solid fa-arrow-right text-[10px]"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Indicator bullets -->
            <div class="flex justify-center items-center gap-2 mt-4">
                <button type="button" aria-label="Eiko Nano 250" data-index="0"
                    class="carousel-bullet active w-8 h-1.5 bg-red-600 rounded-full cursor-pointer"></button>
                <button type="button" aria-label="Eiko Pro Artisan 1.2" data-index="1"
                    class="carousel-bullet w-2.5 h-1.5 bg-gray-300 dark:bg-slate-700 rounded-full cursor-pointer"></button>
                <button type="button" aria-label="Eiko Commercial 5" data-index="2"
                    class="carousel-bullet w-2.5 h-1.5 bg-gray-300 dark:bg-slate-700 rounded-full cursor-pointer"></button>
                <button type="button" aria-label="Eiko Master 12" data-index="3"
                    class="carousel-bullet w-2.5 h-1.5 bg-gray-300 dark:bg-slate-700 rounded-full cursor-pointer"></button>
                <button type="button" aria-label="Eiko MegaPlant 30" data-index="4"
                    class="carousel-bullet w-2.5 h-1.5 bg-gray-300 dark:bg-slate-700 rounded-full cursor-pointer"></button>
            </div>
        </div>
    </section>
    <!-- END: ProductShowcaseCarousel -->

    <!-- BEGIN: WhyChooseEikoSection -->
    <section class="py-20 bg-white dark:bg-brand-dark relative overflow-hidden" id="about">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-red-600 dark:text-red-500 font-bold uppercase tracking-widest text-xs">{{ __('messages.about.badge') }}</span>
                <h2
                    class="font-condensed text-4xl sm:text-5xl font-bold uppercase text-slate-900 dark:text-white tracking-tight mt-2">
                    {{ __('messages.about.title') }} <span class="text-red-600">{{ __('messages.about.title_red') }}</span>
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base mt-3">
                    {{ __('messages.about.description') }}
                </p>
            </div>
            <!-- 3 Pillars Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Pillar 1 -->
                <div
                    class="p-8 rounded-2xl bg-gray-50 dark:bg-slate-900/90 border border-gray-200 dark:border-slate-800 relative hover:border-red-600/60 transition-all duration-300">
                    <div
                        class="w-14 h-14 rounded-xl bg-red-600/10 border border-red-600/30 text-red-600 dark:text-red-500 flex items-center justify-center text-2xl mb-6">
                        <i class="fa-solid fa-sliders"></i>
                    </div>
                    <span
                        class="text-xs font-mono font-bold text-red-600 dark:text-red-500 uppercase tracking-widest">{{ __('messages.about.pillar_label') }}
                        01</span>
                    <h3 class="font-condensed text-2xl font-bold uppercase text-slate-900 dark:text-white mt-1 mb-3">
                        {{ __('messages.about.pillar1.title') }}</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">{{ __('messages.about.pillar1.desc') }}</p>
                    <div
                        class="mt-6 pt-4 border-t border-gray-200 dark:border-slate-800 text-xs text-slate-600 dark:text-slate-300 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-red-500"></i>
                        <span>{{ __('messages.about.pillar1.footer') }}</span>
                    </div>
                </div>
                <!-- Pillar 2 -->
                <div
                    class="p-8 rounded-2xl bg-gray-50 dark:bg-slate-900/90 border border-gray-200 dark:border-slate-800 relative hover:border-red-600/60 transition-all duration-300">
                    <div
                        class="w-14 h-14 rounded-xl bg-red-600/10 border border-red-600/30 text-red-600 dark:text-red-500 flex items-center justify-center text-2xl mb-6">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <span
                        class="text-xs font-mono font-bold text-red-600 dark:text-red-500 uppercase tracking-widest">{{ __('messages.about.pillar_label') }}
                        02</span>
                    <h3 class="font-condensed text-2xl font-bold uppercase text-slate-900 dark:text-white mt-1 mb-3">
                        {{ __('messages.about.pillar2.title') }}</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">{{ __('messages.about.pillar2.desc') }}</p>
                    <div
                        class="mt-6 pt-4 border-t border-gray-200 dark:border-slate-800 text-xs text-slate-600 dark:text-slate-300 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-red-500"></i>
                        <span>{{ __('messages.about.pillar2.footer') }}</span>
                    </div>
                </div>
                <!-- Pillar 3 -->
                <div
                    class="p-8 rounded-2xl bg-gray-50 dark:bg-slate-900/90 border border-gray-200 dark:border-slate-800 relative hover:border-red-600/60 transition-all duration-300">
                    <div
                        class="w-14 h-14 rounded-xl bg-red-600/10 border border-red-600/30 text-red-600 dark:text-red-500 flex items-center justify-center text-2xl mb-6">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <span
                        class="text-xs font-mono font-bold text-red-600 dark:text-red-500 uppercase tracking-widest">{{ __('messages.about.pillar_label') }}
                        03</span>
                    <h3 class="font-condensed text-2xl font-bold uppercase text-slate-900 dark:text-white mt-1 mb-3">
                        {{ __('messages.about.pillar3.title') }}</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">{{ __('messages.about.pillar3.desc') }}</p>
                    <div
                        class="mt-6 pt-4 border-t border-gray-200 dark:border-slate-800 text-xs text-slate-600 dark:text-slate-300 flex items-center gap-2">
                        <i class="fa-solid fa-circle-check text-red-500"></i>
                        <span>{{ __('messages.about.pillar3.footer') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: WhyChooseEikoSection -->

    <!-- BEGIN: ServicesAndSupportSection -->
    <section class="py-20 bg-gray-100 dark:bg-brand-navy border-t border-gray-200 dark:border-slate-800"
        id="services">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left details -->
                <div class="lg:col-span-5">
                    <span class="text-red-600 dark:text-red-500 font-bold uppercase tracking-widest text-xs">{{ __('messages.services.badge') }}</span>
                    <h2
                        class="font-condensed text-4xl sm:text-5xl font-bold uppercase text-slate-900 dark:text-white tracking-tight mt-2 mb-6">
                        {{ __('messages.services.title') }} <br /><span class="text-red-600">{{ __('messages.services.title_red') }}</span>
                    </h2>
                    <p class="text-slate-600 dark:text-slate-300 text-sm sm:text-base leading-relaxed mb-6">
                        {{ __('messages.services.description') }}
                    </p>
                    <div class="space-y-4 text-sm text-slate-700 dark:text-slate-200">
                        <div class="flex items-start gap-3">
                            <div
                                class="w-7 h-7 rounded-full bg-red-600/20 text-red-600 dark:text-red-500 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-screwdriver-wrench text-xs"></i>
                            </div>
                            <div>
                                <strong class="text-slate-900 dark:text-white block font-medium">{{ __('messages.services.item1.title') }}</strong>
                                <span class="text-slate-500 dark:text-slate-400 text-xs">{{ __('messages.services.item1.desc') }}</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div
                                class="w-7 h-7 rounded-full bg-red-600/20 text-red-600 dark:text-red-500 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-boxes-stacked text-xs"></i>
                            </div>
                            <div>
                                <strong class="text-slate-900 dark:text-white block font-medium">{{ __('messages.services.item2.title') }}</strong>
                                <span class="text-slate-500 dark:text-slate-400 text-xs">{{ __('messages.services.item2.desc') }}</span>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div
                                class="w-7 h-7 rounded-full bg-red-600/20 text-red-600 dark:text-red-500 flex items-center justify-center shrink-0 mt-0.5">
                                <i class="fa-solid fa-shield-heart text-xs"></i>
                            </div>
                            <div>
                                <strong class="text-slate-900 dark:text-white block font-medium">{{ __('messages.services.item3.title') }}</strong>
                                <span class="text-slate-500 dark:text-slate-400 text-xs">{{ __('messages.services.item3.desc') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8">
                        <a class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-6 py-3 rounded-lg shadow-lg shadow-red-600/30 transition-all"
                            href="https://wa.me/6281234567890?text=Halo%20Eiko,%20saya%20ingin%20konsultasi%20mesin%20roasting">
                            <i class="fa-brands fa-whatsapp text-lg"></i>
                            <span>{{ __('messages.services.cta') }}</span>
                        </a>
                    </div>
                </div>
                <!-- Right Visual Showcase -->
                <div class="lg:col-span-7">
                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="rounded-xl overflow-hidden border border-gray-300 dark:border-slate-700 h-64 shadow-xl">
                            <img alt="Pabrik Perakitan Mesin Roasting"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBuYJZXXqyHj-rzk0cKZ4-qksuS48PMxsJHQFRi_CnGpqqUWA19kJM-KJYR1cPVlIIx3Y4SG0_K83P5BfSZ0dhXP6yuIq5OQbKo_9OjPkgpiw-_9dQDioh9UHScT3KsyA1wBh9-Ah5s6l9sJjCzYR8zsP43dFN8nUfceHYQO-kH7UFq_uv1eRESzVUHgLXEDzmO2bByffHbWGrOhYSjEAj6WAJuwfC04OUSiEqTGoTXt3_LhSPS7d_Q" />
                        </div>
                        <div
                            class="rounded-xl overflow-hidden border border-gray-300 dark:border-slate-700 h-64 shadow-xl">
                            <img alt="Coffee Bean Cupping and Quality Inspection"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuD16CqxUv0bh_6H8twvXO53lEuWYT4SZIjO4IB6o2gly8Ft4gRFr9b1lFBG4-4JhMY_LSd1970C28mCBowqqD8RKyeawThcz98a6I90rfCkPZxTuynMkMY7S_C6Pm3rishDRVhVQS2jptwpCHU5xKUStc1RkgTAJs3l3d2_HUe2EnNfWHIbtC3S6KalqSEoxzVl-wb82mcCgDYetr15tsy2jW_aIhwQd7-em3KZqQAqXGH7i1ZwDWPt" />
                        </div>
                        <div
                            class="rounded-xl overflow-hidden border border-gray-300 dark:border-slate-700 h-52 col-span-2 relative shadow-xl">
                            <img alt="Workshop Bengkel Mesin Kopi Eiko"
                                class="w-full h-full object-cover filter brightness-75 dark:brightness-75"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBChILsb0Gg95MmEsQVVrUp38xFeJJdpp6xf3YPGF0rafTz_0ANTpSCaYcwxv6GmhFTTEMbqz6AIMtC0cxlJGmJgJ9aE7STJXR4J-MbbN0qXpGdJ_7jJsivHfpwspvTjEwms97u5bVZExS_XZGOgB3t4mGX916kKjL2P__2xFFETlEZhA35h3PLLFB9A6BpzpdASmcsRYaTBTCGhyzhKzrwVVC0qKlcQRVYkWzVRKp65lCCaEnh8hY8" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-gray-900/90 dark:from-slate-950 via-gray-900/40 dark:via-slate-950/40 to-transparent flex items-end p-6">
                                <div>
                                    <p class="text-white font-condensed uppercase text-xl font-bold tracking-wide">
                                        {{ __('messages.services.workshop_title') }}</p>
                                    <p class="text-xs text-gray-200 dark:text-slate-300">{{ __('messages.services.workshop_desc') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END: ServicesAndSupportSection -->

    <!-- BEGIN: ExportNetworkSection -->
    <section class="py-16 bg-gray-50 dark:bg-slate-950 border-b border-gray-200 dark:border-slate-800/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <p class="text-xs uppercase tracking-widest text-slate-500 dark:text-slate-400 font-semibold">
                    {{ __('messages.export.tagline') }}
                </p>
            </div>
            <!-- Countries and regions pill tags -->
            <div
                class="flex flex-wrap justify-center items-center gap-3 md:gap-5 text-xs sm:text-sm font-medium text-slate-700 dark:text-slate-300">
                <span
                    class="px-4 py-2 rounded-lg bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex items-center gap-2 hover:border-red-500/50 transition-colors">
                    <span class="text-base">🇮🇩</span> {{ __('messages.export.indonesia') }}
                </span>
                <span
                    class="px-4 py-2 rounded-lg bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex items-center gap-2 hover:border-red-500/50 transition-colors">
                    <span class="text-base">🇲🇾</span> Malaysia
                </span>
                <span
                    class="px-4 py-2 rounded-lg bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex items-center gap-2 hover:border-red-500/50 transition-colors">
                    <span class="text-base">🇧🇳</span> {{ __('messages.export.brunei') }}
                </span>
                <span
                    class="px-4 py-2 rounded-lg bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex items-center gap-2 hover:border-red-500/50 transition-colors">
                    <span class="text-base">🇹🇱</span> {{ __('messages.export.timor') }}
                </span>
                <span
                    class="px-4 py-2 rounded-lg bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex items-center gap-2 hover:border-red-500/50 transition-colors">
                    <span class="text-base">🇹🇭</span> Thailand
                </span>
                <span
                    class="px-4 py-2 rounded-lg bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex items-center gap-2 hover:border-red-500/50 transition-colors">
                    <span class="text-base">🇻🇳</span> Vietnam
                </span>
                <span
                    class="px-4 py-2 rounded-lg bg-white dark:bg-slate-900 border border-gray-200 dark:border-slate-800 flex items-center gap-2 hover:border-red-500/50 transition-colors">
                    <span class="text-base">🇯🇵</span> {{ __('messages.export.japan') }}
                </span>
            </div>
        </div>
    </section>
    <!-- END: ExportNetworkSection -->

    <!-- BEGIN: ContactAndInquiryFooter -->
    <footer class="bg-gray-100 dark:bg-brand-dark pt-16 pb-12 border-t border-gray-200 dark:border-slate-800"
        id="contact">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Top Grid -->
            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-gray-200 dark:border-slate-800">
                <!-- Col 1: Brand Info -->
                <div>
                    <div class="flex items-center gap-2 group mb-4">
                         <img src="{{ asset('images/logo_eiko.png') }}" alt="" class="p-1 w-auto h-12 dark:invert">
                    </div>
                    <p class="text-slate-600 dark:text-slate-400 text-xs leading-relaxed mb-6">
                        {{ __('messages.footer.brand_desc') }}
                    </p>
                    <div class="flex items-center gap-3 text-slate-500 dark:text-slate-400">
                        <a class="w-8 h-8 rounded-full bg-gray-200 dark:bg-slate-800 hover:bg-red-600 hover:text-white transition-colors flex items-center justify-center text-xs"
                            href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a class="w-8 h-8 rounded-full bg-gray-200 dark:bg-slate-800 hover:bg-red-600 hover:text-white transition-colors flex items-center justify-center text-xs"
                            href="#"><i class="fa-brands fa-youtube"></i></a>
                        <a class="w-8 h-8 rounded-full bg-gray-200 dark:bg-slate-800 hover:bg-red-600 hover:text-white transition-colors flex items-center justify-center text-xs"
                            href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a class="w-8 h-8 rounded-full bg-gray-200 dark:bg-slate-800 hover:bg-red-600 hover:text-white transition-colors flex items-center justify-center text-xs"
                            href="#"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
                <!-- Col 2: Quick Links -->
                <div>
                    <h4
                        class="font-condensed text-lg uppercase text-slate-900 dark:text-white font-bold tracking-wider mb-4 border-l-2 border-red-600 pl-2.5">
                        {{ __('messages.footer.machine_categories') }}</h4>
                    <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                        <li><a class="hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                href="#products">{{ __('messages.footer.cat1') }}</a></li>
                        <li><a class="hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                href="#products">{{ __('messages.footer.cat2') }}</a></li>
                        <li><a class="hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                href="#products">{{ __('messages.footer.cat3') }}</a></li>
                        <li><a class="hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                href="#products">{{ __('messages.footer.cat4') }}</a></li>
                        <li><a class="hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                href="#products">{{ __('messages.footer.cat5') }}</a></li>
                    </ul>
                </div>
                <!-- Col 3: Layanan & Informasi -->
                <div>
                    <h4
                        class="font-condensed text-lg uppercase text-slate-900 dark:text-white font-bold tracking-wider mb-4 border-l-2 border-red-600 pl-2.5">
                        {{ __('messages.footer.support') }}</h4>
                    <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                        <li><a class="hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                href="#services">{{ __('messages.footer.sup1') }}</a></li>
                        <li><a class="hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                href="#services">{{ __('messages.footer.sup2') }}</a></li>
                        <li><a class="hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                href="#services">{{ __('messages.footer.sup3') }}</a></li>
                        <li><a class="hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                href="#services">{{ __('messages.footer.sup4') }}</a></li>
                        <li><a class="hover:text-red-600 dark:hover:text-red-400 transition-colors"
                                href="#services">{{ __('messages.footer.sup5') }}</a></li>
                    </ul>
                </div>
                <!-- Col 4: Hubungi Kami -->
                <div>
                    <h4
                        class="font-condensed text-lg uppercase text-slate-900 dark:text-white font-bold tracking-wider mb-4 border-l-2 border-red-600 pl-2.5">
                        {{ __('messages.footer.workshop') }}</h4>
                    <div class="text-xs text-slate-600 dark:text-slate-400 space-y-3">
                        <p class="flex items-start gap-2.5">
                            <i class="fa-solid fa-location-dot text-red-500 mt-1 shrink-0"></i>
                            <span>{{ __('messages.footer.address') }}</span>
                        </p>
                        <p class="flex items-center gap-2.5">
                            <i class="fa-solid fa-phone text-red-500 shrink-0"></i>
                            <span>+62 812-3456-7890 / (021) 789-0123</span>
                        </p>
                        <p class="flex items-center gap-2.5">
                            <i class="fa-solid fa-envelope text-red-500 shrink-0"></i>
                            <span>sales@eikocoffeeroaster.com</span>
                        </p>
                        <p class="flex items-center gap-2.5">
                            <i class="fa-solid fa-clock text-red-500 shrink-0"></i>
                            <span>{{ __('messages.footer.hours') }}</span>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Bottom Credits -->
            <div
                class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 dark:text-slate-500 gap-4">
                <p>{{ __('messages.footer.copyright') }}</p>
                <div class="flex items-center gap-4">
                    <a class="hover:text-slate-700 dark:hover:text-slate-400" href="#">{{ __('messages.footer.privacy') }}</a>
                    <span>•</span>
                    <a class="hover:text-slate-700 dark:hover:text-slate-400" href="#">{{ __('messages.footer.terms') }}</a>
                    <span>•</span>
                    <a class="hover:text-slate-700 dark:hover:text-slate-400" href="#">Indonesia</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- END: ContactAndInquiryFooter -->

    <!-- BEGIN: UnitDetailModal -->
    <div id="unitModal"
        class="hidden fixed inset-0 z-[70] flex items-center justify-center p-4"
        role="dialog" aria-modal="true" aria-labelledby="unitModalTitle">
        <div id="unitModalBackdrop" class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
        <div
            class="relative w-full max-w-2xl max-h-[90vh] overflow-y-auto bg-white dark:bg-brand-navy rounded-2xl border border-gray-200 dark:border-slate-700 shadow-2xl">
            <button id="unitModalClose" aria-label="Close"
                class="absolute top-3 right-3 z-10 w-9 h-9 rounded-full bg-gray-100 dark:bg-slate-800 text-slate-600 dark:text-slate-200 hover:bg-red-600 hover:text-white transition-colors flex items-center justify-center">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="relative h-64 sm:h-72 bg-gray-100 dark:bg-slate-800 overflow-hidden rounded-t-2xl">
                <img id="unitModalImg" src="" alt="" class="w-full h-full object-cover">
                <span id="unitModalBadge"
                    class="hidden absolute top-4 left-4 bg-red-600 text-white text-[10px] font-black uppercase tracking-widest px-2.5 py-0.5 rounded shadow"></span>
                <span id="unitModalCapacity"
                    class="absolute top-4 right-4 bg-red-600 text-white text-xs font-bold px-3 py-1.5 rounded shadow"></span>
            </div>
            <div class="p-6 sm:p-8">
                <p id="unitModalCategory"
                    class="text-xs font-semibold text-red-600 dark:text-red-500 uppercase tracking-wider"></p>
                <h3 id="unitModalTitle"
                    class="font-condensed text-3xl font-bold uppercase text-slate-900 dark:text-white mt-1"></h3>
                <p id="unitModalStatus" class="text-xs text-green-600 dark:text-green-400 font-medium mt-2"></p>
                <p id="unitModalDesc" class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mt-4"></p>
                <div class="mt-6 pt-5 border-t border-gray-200 dark:border-slate-800">
                    <h4
                        class="font-condensed uppercase text-sm font-bold text-slate-900 dark:text-white tracking-wider mb-3">
                        {{ __('messages.products.modal_features') }}</h4>
                    <ul id="unitModalFeatures" class="space-y-2.5 text-sm text-slate-600 dark:text-slate-300"></ul>
                </div>
                <div class="mt-7 pt-5 border-t border-gray-200 dark:border-slate-800">
                    <a id="unitModalWhatsapp" href="https://wa.me/6281234567890" target="_blank"
                        class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold px-6 py-3 rounded-lg shadow-lg shadow-red-600/30 transition-all">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                        <span>{{ __('messages.products.cta_whatsapp') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END: UnitDetailModal -->

    <!-- BEGIN: InteractiveScripts -->
    <script data-purpose="carousel-and-nav-events">
        document.addEventListener('DOMContentLoaded', () => {
            // Language Switcher Dropdown Logic
            const langSwitcher = document.getElementById('langSwitcher');
            const langBtn = document.getElementById('langBtn');
            const langMenu = document.getElementById('langMenu');

            if (langSwitcher && langBtn && langMenu) {
                langBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    langMenu.classList.toggle('hidden');
                    langBtn.setAttribute('aria-expanded', langMenu.classList.contains('hidden') ? 'false' : 'true');
                });

                document.addEventListener('click', (e) => {
                    if (!langSwitcher.contains(e.target)) {
                        langMenu.classList.add('hidden');
                        langBtn.setAttribute('aria-expanded', 'false');
                    }
                });

                langMenu.addEventListener('click', (e) => e.stopPropagation());
            }

            // Theme Toggle Logic
            const themeToggleBtn = document.getElementById('themeToggle');
            const htmlElement = document.documentElement;

            // Check local storage or system preference
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia(
                    '(prefers-color-scheme: dark)').matches)) {
                htmlElement.classList.add('dark');
            } else {
                htmlElement.classList.remove('dark');
            }

            themeToggleBtn.addEventListener('click', () => {
                if (htmlElement.classList.contains('dark')) {
                    htmlElement.classList.remove('dark');
                    localStorage.theme = 'light';
                } else {
                    htmlElement.classList.add('dark');
                    localStorage.theme = 'dark';
                }
            });

            // Carousel: border aktif mengikuti slide + bullets dapat diklik
            const carousel = document.getElementById('roasterCarousel');
            const prevBtn = document.getElementById('carouselPrevBtn');
            const nextBtn = document.getElementById('carouselNextBtn');
            const roasterCards = Array.from(document.querySelectorAll('.roaster-card'));
            const bullets = Array.from(document.querySelectorAll('.carousel-bullet'));

            function setActiveSlide(index) {
                bullets.forEach((bullet, i) => {
                    bullet.classList.toggle('active', i === index);
                });
            }

            function updateActiveSlide() {
                if (!carousel || roasterCards.length === 0) return;
                const carouselLeft = carousel.getBoundingClientRect().left;
                let active = 0;
                let min = Infinity;
                roasterCards.forEach((card, i) => {
                    const cr = card.getBoundingClientRect();
                    const dist = Math.abs(cr.left - carouselLeft);
                    if (dist < min) {
                        min = dist;
                        active = i;
                    }
                });
                setActiveSlide(active);
            }

            function scrollToCard(index) {
                if (!carousel || !roasterCards[index]) return;
                const target = roasterCards[index].getBoundingClientRect().left -
                    carousel.getBoundingClientRect().left + carousel.scrollLeft;
                carousel.scrollTo({ left: target, behavior: 'smooth' });
            }

            if (carousel) {
                carousel.addEventListener('scroll', () => {
                    window.requestAnimationFrame(updateActiveSlide);
                });
                window.addEventListener('resize', updateActiveSlide);
                window.addEventListener('load', updateActiveSlide);
                updateActiveSlide();
            }

            if (carousel && prevBtn && nextBtn) {
                const step = () => (roasterCards[0] ? roasterCards[0].offsetWidth + 24 : 340);
                prevBtn.addEventListener('click', () => {
                    carousel.scrollBy({ left: -step(), behavior: 'smooth' });
                });
                nextBtn.addEventListener('click', () => {
                    carousel.scrollBy({ left: step(), behavior: 'smooth' });
                });
            }

            bullets.forEach((bullet, i) => {
                bullet.addEventListener('click', () => scrollToCard(i));
            });

            // Unit Detail Modal (popup)
            const unitModal = document.getElementById('unitModal');
            const unitModalClose = document.getElementById('unitModalClose');
            const unitModalBackdrop = document.getElementById('unitModalBackdrop');

            function openUnitModal(card) {
                const img = card.querySelector('img');
                const cap = card.querySelector('.card-capacity');
                const badge = card.querySelector('.card-badge');
                const status = card.querySelector('.card-status');
                const category = card.querySelector('.card-category');
                const title = card.querySelector('.card-title');
                const desc = card.querySelector('.card-desc');

                document.getElementById('unitModalImg').src = img ? img.src : '';
                document.getElementById('unitModalImg').alt = img ? (img.alt || '') : '';
                document.getElementById('unitModalCategory').textContent = category ? category.textContent.trim() : '';
                document.getElementById('unitModalTitle').textContent = title ? title.textContent.trim() : '';
                document.getElementById('unitModalDesc').textContent = desc ? desc.textContent.trim() : '';
                document.getElementById('unitModalStatus').textContent = status ? status.textContent.trim() : '';
                document.getElementById('unitModalCapacity').textContent = cap ? cap.textContent.trim() : '';

                const badgeEl = document.getElementById('unitModalBadge');
                if (badge) {
                    badgeEl.textContent = badge.textContent.trim();
                    badgeEl.classList.remove('hidden');
                } else {
                    badgeEl.classList.add('hidden');
                }

                const features = document.getElementById('unitModalFeatures');
                features.innerHTML = '';
                card.querySelectorAll('.card-feature').forEach((item) => {
                    const li = document.createElement('li');
                    li.className = 'flex items-center gap-2.5';
                    const icon = document.createElement('i');
                    icon.className = 'fa-solid fa-check text-red-500 text-xs';
                    const txt = document.createTextNode(item.textContent.trim());
                    li.appendChild(icon);
                    li.appendChild(txt);
                    features.appendChild(li);
                });

                const name = document.getElementById('unitModalTitle').textContent;
                document.getElementById('unitModalWhatsapp').href =
                    'https://wa.me/6281234567890?text=' + encodeURIComponent('Halo Eiko, saya ingin menanyakan unit ' + name);

                unitModal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeUnitModal() {
                unitModal.classList.add('hidden');
                document.body.style.overflow = '';
            }

            document.querySelectorAll('.open-detail').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const card = btn.closest('.roaster-card');
                    if (card) openUnitModal(card);
                });
            });

            if (unitModalClose) unitModalClose.addEventListener('click', closeUnitModal);
            if (unitModalBackdrop) unitModalBackdrop.addEventListener('click', closeUnitModal);
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && unitModal && !unitModal.classList.contains('hidden')) {
                    closeUnitModal();
                }
            });

            // Smooth scroll for anchor tags
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
    <!-- END: InteractiveScripts -->
</body>

</html>

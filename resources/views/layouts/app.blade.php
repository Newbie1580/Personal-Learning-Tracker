<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Personal Learning Tracker') }} - @yield('title', 'Dashboard')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen text-stone-800 antialiased"
    x-data="{ deleteOpen: false, deleteAction: '', deleteName: '' }"
    @open-delete.window="deleteAction = $event.detail.action; deleteName = $event.detail.name; deleteOpen = true">

    <header class="anim-drop sticky top-0 z-40 border-b border-stone-900/10 bg-[#f5f1e8]/90 shadow-[0_1px_10px_rgba(28,25,23,0.06)] backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="group flex min-w-0 items-center gap-3">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-900 text-amber-100 shadow-md transition-transform duration-300 group-hover:-rotate-6">
                    <i data-lucide="library" class="h-5 w-5"></i>
                </span>
                <span class="min-w-0 leading-tight">
                    <span class="block truncate text-sm font-extrabold text-stone-900">Personal Learning Tracker</span>
                    <span class="block text-[11px] font-bold uppercase tracking-[0.14em] text-orange-700">ITE 311 &middot; Lab 4 MVC CRUD</span>
                </span>
            </a>
            <nav class="hidden items-center gap-1 text-sm font-bold md:flex">
                <a href="{{ route('home') }}" class="flex items-center gap-1.5 rounded-full px-4 py-2 transition {{ request()->routeIs('home') ? 'bg-stone-900 text-amber-50 shadow-md' : 'text-stone-500 hover:bg-stone-900/5 hover:text-stone-900' }}">
                    <i data-lucide="home" class="h-4 w-4"></i>
                    Home
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center gap-1.5 rounded-full px-4 py-2 transition {{ request()->routeIs('categories.*') ? 'bg-stone-900 text-amber-50 shadow-md' : 'text-stone-500 hover:bg-stone-900/5 hover:text-stone-900' }}">
                    <i data-lucide="tags" class="h-4 w-4"></i>
                    Categories
                </a>
                <a href="{{ route('learning-resources.index') }}" class="flex items-center gap-1.5 rounded-full px-4 py-2 transition {{ request()->routeIs('learning-resources.*') ? 'bg-stone-900 text-amber-50 shadow-md' : 'text-stone-500 hover:bg-stone-900/5 hover:text-stone-900' }}">
                    <i data-lucide="book-open" class="h-4 w-4"></i>
                    Resources
                </a>
                <a href="{{ route('skills.index') }}" class="flex items-center gap-1.5 rounded-full px-4 py-2 transition {{ request()->routeIs('skills.*') ? 'bg-stone-900 text-amber-50 shadow-md' : 'text-stone-500 hover:bg-stone-900/5 hover:text-stone-900' }}">
                    <i data-lucide="sparkles" class="h-4 w-4"></i>
                    Skills
                </a>
            </nav>
            <div class="hidden items-center gap-3 md:flex">
                <span class="hidden items-center gap-1.5 rounded-full border border-stone-900/15 px-3 py-1.5 text-xs font-bold text-stone-500 lg:inline-flex">
                    <i data-lucide="flame" class="h-3.5 w-3.5 text-orange-700"></i>
                    Laravel {{ app()->version() }}
                </span>
            </div>
            <div class="md:hidden" x-data="{ open: false }">
                <button @click="open = !open" class="rounded-xl border border-stone-900/15 bg-white p-2.5 text-stone-600 shadow-sm" aria-label="Toggle menu">
                    <i data-lucide="menu" class="h-5 w-5" x-show="!open"></i>
                    <i data-lucide="x" class="h-5 w-5" x-show="open" x-cloak></i>
                </button>
                <div x-show="open" x-cloak @click.outside="open = false" class="absolute inset-x-4 top-20 z-50 rounded-2xl border border-stone-900/10 bg-white p-2 shadow-xl">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-bold text-stone-700 hover:bg-orange-50"><i data-lucide="home" class="h-4 w-4"></i>Home</a>
                    <a href="{{ route('categories.index') }}" class="flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-bold text-stone-700 hover:bg-orange-50"><i data-lucide="tags" class="h-4 w-4"></i>Categories</a>
                    <a href="{{ route('learning-resources.index') }}" class="flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-bold text-stone-700 hover:bg-orange-50"><i data-lucide="book-open" class="h-4 w-4"></i>Resources</a>
                    <a href="{{ route('skills.index') }}" class="flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-bold text-stone-700 hover:bg-orange-50"><i data-lucide="sparkles" class="h-4 w-4"></i>Skills</a>
                </div>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition class="anim-rise mb-6 flex items-start gap-3 rounded-2xl border border-green-900/20 bg-[#e9efe4] px-4 py-3.5 text-sm font-medium text-green-950 shadow-sm">
                <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-green-900 text-amber-100">
                    <i data-lucide="check" class="h-3.5 w-3.5"></i>
                </span>
                <p class="flex-1">{{ session('success') }}</p>
                <button @click="show = false" class="text-green-900/40 transition hover:text-green-900" aria-label="Dismiss">
                    <i data-lucide="x" class="h-4 w-4"></i>
                </button>
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div class="anim-rise mb-6 rounded-2xl border border-red-900/20 bg-[#f7e8e2] px-4 py-3.5 text-sm text-red-950 shadow-sm">
                <p class="flex items-center gap-2 font-bold">
                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-red-800 text-amber-50">
                        <i data-lucide="info" class="h-3.5 w-3.5"></i>
                    </span>
                    Please fix the following:
                </p>
                <ul class="mt-2 list-disc space-y-0.5 pl-11">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="mt-8 border-t border-stone-900/10 bg-[#efe9da]">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-4 py-6 text-xs text-stone-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
            <p class="flex items-center gap-2">
                <span class="flex h-6 w-6 items-center justify-center rounded-md bg-green-900 text-amber-100">
                    <i data-lucide="library" class="h-3.5 w-3.5"></i>
                </span>
                <span class="font-semibold">Personal Learning Tracker &middot; ITE 311 Lab 4</span>
            </p>
            <p class="flex flex-wrap gap-1.5">
                <span class="rounded-full bg-stone-900/5 px-2.5 py-1 font-bold text-stone-600">Laravel {{ app()->version() }}</span>
                <span class="rounded-full bg-stone-900/5 px-2.5 py-1 font-bold text-stone-600">Tailwind v4</span>
                <span class="rounded-full bg-stone-900/5 px-2.5 py-1 font-bold text-stone-600">Lucide</span>
            </p>
        </div>
    </footer>

    <!-- Global delete confirmation modal -->
    <div x-show="deleteOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-stone-950/50 backdrop-blur-sm" @click="deleteOpen = false"></div>
        <div class="modal-panel relative w-full max-w-md rounded-3xl bg-[#faf7f0] p-6 shadow-2xl"
            x-show="deleteOpen"
            x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0 scale-95 translate-y-3" x-transition:enter-end="opacity-100 scale-100 translate-y-0">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-red-800 text-amber-50">
                <i data-lucide="trash-2" class="h-6 w-6"></i>
            </div>
            <h3 class="mt-4 text-center font-display text-xl font-semibold text-stone-900">Delete this record?</h3>
            <p class="mt-1 text-center text-sm text-stone-500">“<span class="font-bold text-stone-700" x-text="deleteName"></span>” will be permanently removed. This action cannot be undone.</p>
            <div class="mt-6 grid grid-cols-2 gap-3">
                <button @click="deleteOpen = false" class="rounded-xl border border-stone-900/15 bg-white px-4 py-2.5 text-sm font-bold text-stone-600 transition hover:bg-stone-100">Cancel</button>
                <form :action="deleteAction" method="POST" class="contents">
                    @csrf
                    @method('DELETE')
                    <button class="rounded-xl bg-red-800 px-4 py-2.5 text-sm font-bold text-amber-50 shadow-lg transition hover:bg-red-900">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide) {
                lucide.createIcons();
            }

            var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            // Animated counters: <span data-count="42">0</span>
            document.querySelectorAll('[data-count]').forEach(function (el) {
                var target = parseInt(el.getAttribute('data-count'), 10) || 0;
                if (reduceMotion) {
                    el.textContent = target;
                    return;
                }
                var duration = 900;
                var start = null;
                function tick(now) {
                    if (!start) start = now;
                    var progress = Math.min((now - start) / duration, 1);
                    var eased = 1 - Math.pow(1 - progress, 3);
                    el.textContent = Math.round(target * eased);
                    if (progress < 1) requestAnimationFrame(tick);
                }
                requestAnimationFrame(tick);
            });
        });
    </script>
</body>
</html>

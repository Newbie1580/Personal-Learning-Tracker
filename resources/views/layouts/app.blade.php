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
    x-data="{ deleteOpen: false, deleteAction: '', deleteName: '', sidebarCollapsed: false, mobileOpen: false }"
    x-init="sidebarCollapsed = localStorage.getItem('plt-sidebar') === '1'; $watch('sidebarCollapsed', value => localStorage.setItem('plt-sidebar', value ? '1' : '0'))"
    @open-delete.window="deleteAction = $event.detail.action; deleteName = $event.detail.name; deleteOpen = true"
    :class="{ 'overflow-hidden': mobileOpen }">

    <div class="flex min-h-screen">
        <!-- Desktop sidebar (left) -->
        <aside aria-label="Primary"
            class="sticky top-0 hidden h-screen shrink-0 flex-col border-r border-stone-900/10 bg-[#f5f1e8]/95 backdrop-blur-xl transition-all duration-300 motion-reduce:transition-none md:flex"
            :class="sidebarCollapsed ? 'w-[76px] px-2.5' : 'w-64 px-4'">
            <div class="flex items-center py-5" :class="sidebarCollapsed ? 'justify-center' : 'gap-3 px-1'">
                <a href="{{ route('home') }}" class="group flex min-w-0 items-center gap-3" :class="sidebarCollapsed && 'justify-center'">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-900 text-amber-100 shadow-md transition-transform duration-300 group-hover:-rotate-6">
                        <i data-lucide="library" class="h-5 w-5"></i>
                    </span>
                    <span class="min-w-0 leading-tight" x-show="!sidebarCollapsed" x-transition.opacity>
                        <span class="block truncate text-sm font-extrabold text-stone-900">Personal Learning Tracker</span>
                        <span class="block text-[11px] font-bold uppercase tracking-[0.14em] text-orange-700">ITE 311 &middot; Lab 4</span>
                    </span>
                </a>
            </div>

            <nav class="flex flex-1 flex-col gap-1.5 overflow-y-auto overflow-x-hidden py-2 text-sm font-bold">
                <a href="{{ route('home') }}" title="Home"
                    class="flex items-center gap-3 rounded-2xl px-3.5 py-2.5 transition {{ request()->routeIs('home') ? 'bg-stone-900 text-amber-50 shadow-md' : 'text-stone-500 hover:bg-stone-900/5 hover:text-stone-900' }}"
                    :class="sidebarCollapsed && 'justify-center px-0'">
                    <i data-lucide="home" class="h-5 w-5 shrink-0"></i>
                    <span x-show="!sidebarCollapsed" class="truncate">Home</span>
                </a>
                <a href="{{ route('categories.index') }}" title="Categories"
                    class="flex items-center gap-3 rounded-2xl px-3.5 py-2.5 transition {{ request()->routeIs('categories.*') ? 'bg-stone-900 text-amber-50 shadow-md' : 'text-stone-500 hover:bg-stone-900/5 hover:text-stone-900' }}"
                    :class="sidebarCollapsed && 'justify-center px-0'">
                    <i data-lucide="tags" class="h-5 w-5 shrink-0"></i>
                    <span x-show="!sidebarCollapsed" class="truncate">Categories</span>
                </a>
                <a href="{{ route('learning-resources.index') }}" title="Resources"
                    class="flex items-center gap-3 rounded-2xl px-3.5 py-2.5 transition {{ request()->routeIs('learning-resources.*') ? 'bg-stone-900 text-amber-50 shadow-md' : 'text-stone-500 hover:bg-stone-900/5 hover:text-stone-900' }}"
                    :class="sidebarCollapsed && 'justify-center px-0'">
                    <i data-lucide="book-open" class="h-5 w-5 shrink-0"></i>
                    <span x-show="!sidebarCollapsed" class="truncate">Resources</span>
                </a>
                <a href="{{ route('skills.index') }}" title="Skills"
                    class="flex items-center gap-3 rounded-2xl px-3.5 py-2.5 transition {{ request()->routeIs('skills.*') ? 'bg-stone-900 text-amber-50 shadow-md' : 'text-stone-500 hover:bg-stone-900/5 hover:text-stone-900' }}"
                    :class="sidebarCollapsed && 'justify-center px-0'">
                    <i data-lucide="sparkles" class="h-5 w-5 shrink-0"></i>
                    <span x-show="!sidebarCollapsed" class="truncate">Skills</span>
                </a>
            </nav>

            <div class="space-y-3 border-t border-stone-900/10 py-4">
                <button type="button" @click="sidebarCollapsed = !sidebarCollapsed" :aria-expanded="!sidebarCollapsed"
                    :title="sidebarCollapsed ? 'Expand sidebar' : 'Collapse sidebar'" aria-label="Toggle sidebar"
                    class="flex w-full items-center gap-3 rounded-2xl px-3.5 py-2.5 text-sm font-bold text-stone-500 transition hover:bg-stone-900/5 hover:text-stone-900"
                    :class="sidebarCollapsed && 'justify-center px-0'">
                    <span x-show="!sidebarCollapsed" class="flex flex-1 items-center gap-3">
                        <i data-lucide="chevrons-left" class="h-5 w-5 shrink-0"></i>
                        <span class="truncate">Collapse</span>
                    </span>
                    <span x-show="sidebarCollapsed" class="flex w-full justify-center">
                        <i data-lucide="chevrons-right" class="h-5 w-5 shrink-0"></i>
                    </span>
                </button>
                <div x-show="!sidebarCollapsed" x-transition.opacity class="flex justify-center">
                    <span class="inline-flex items-center gap-1.5 rounded-full border border-stone-900/15 px-3 py-1.5 text-xs font-bold text-stone-500">
                        <i data-lucide="flame" class="h-3.5 w-3.5 text-orange-700"></i>
                        Laravel {{ app()->version() }}
                    </span>
                </div>
            </div>
        </aside>

        <!-- Mobile drawer backdrop -->
        <div x-show="mobileOpen" x-cloak @click="mobileOpen = false"
            x-transition.opacity
            class="fixed inset-0 z-40 bg-stone-950/50 backdrop-blur-sm md:hidden"></div>

        <!-- Mobile drawer -->
        <aside x-show="mobileOpen" x-cloak
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            @keydown.escape.window="mobileOpen = false"
            aria-label="Mobile navigation"
            class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col border-r border-stone-900/10 bg-[#f5f1e8] px-4 shadow-2xl md:hidden">
            <div class="flex items-center justify-between py-5">
                <a href="{{ route('home') }}" @click="mobileOpen = false" class="flex min-w-0 items-center gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green-900 text-amber-100 shadow-md">
                        <i data-lucide="library" class="h-5 w-5"></i>
                    </span>
                    <span class="min-w-0 leading-tight">
                        <span class="block truncate text-sm font-extrabold text-stone-900">Personal Learning Tracker</span>
                        <span class="block text-[11px] font-bold uppercase tracking-[0.14em] text-orange-700">ITE 311 &middot; Lab 4</span>
                    </span>
                </a>
                <button @click="mobileOpen = false" aria-label="Close menu" class="rounded-xl border border-stone-900/15 bg-white p-2 text-stone-600 shadow-sm">
                    <i data-lucide="x" class="h-5 w-5"></i>
                </button>
            </div>
            <nav class="flex flex-1 flex-col gap-1.5 overflow-y-auto py-2 text-sm font-bold">
                <a href="{{ route('home') }}" @click="mobileOpen = false" class="flex items-center gap-3 rounded-2xl px-4 py-2.5 transition {{ request()->routeIs('home') ? 'bg-stone-900 text-amber-50 shadow-md' : 'text-stone-700 hover:bg-orange-50' }}"><i data-lucide="home" class="h-5 w-5"></i>Home</a>
                <a href="{{ route('categories.index') }}" @click="mobileOpen = false" class="flex items-center gap-3 rounded-2xl px-4 py-2.5 transition {{ request()->routeIs('categories.*') ? 'bg-stone-900 text-amber-50 shadow-md' : 'text-stone-700 hover:bg-orange-50' }}"><i data-lucide="tags" class="h-5 w-5"></i>Categories</a>
                <a href="{{ route('learning-resources.index') }}" @click="mobileOpen = false" class="flex items-center gap-3 rounded-2xl px-4 py-2.5 transition {{ request()->routeIs('learning-resources.*') ? 'bg-stone-900 text-amber-50 shadow-md' : 'text-stone-700 hover:bg-orange-50' }}"><i data-lucide="book-open" class="h-5 w-5"></i>Resources</a>
                <a href="{{ route('skills.index') }}" @click="mobileOpen = false" class="flex items-center gap-3 rounded-2xl px-4 py-2.5 transition {{ request()->routeIs('skills.*') ? 'bg-stone-900 text-amber-50 shadow-md' : 'text-stone-700 hover:bg-orange-50' }}"><i data-lucide="sparkles" class="h-5 w-5"></i>Skills</a>
            </nav>
            <div class="border-t border-stone-900/10 py-4">
                <span class="inline-flex items-center gap-1.5 rounded-full border border-stone-900/15 px-3 py-1.5 text-xs font-bold text-stone-500">
                    <i data-lucide="flame" class="h-3.5 w-3.5 text-orange-700"></i>
                    Laravel {{ app()->version() }}
                </span>
            </div>
        </aside>

        <!-- Right column: topbar + content + footer -->
        <div class="flex min-w-0 flex-1 flex-col">
            <header class="anim-drop sticky top-0 z-30 border-b border-stone-900/10 bg-[#f5f1e8]/90 shadow-[0_1px_10px_rgba(28,25,23,0.06)] backdrop-blur-xl">
                <div class="mx-auto flex h-16 w-full max-w-7xl items-center gap-2 px-4 sm:px-6 lg:px-8">
                    <button type="button" @click="mobileOpen = true" aria-label="Open menu" class="rounded-xl border border-stone-900/15 bg-white p-2.5 text-stone-600 shadow-sm md:hidden">
                        <i data-lucide="menu" class="h-5 w-5"></i>
                    </button>
                    <button type="button" @click="sidebarCollapsed = !sidebarCollapsed" :aria-expanded="!sidebarCollapsed"
                        :title="sidebarCollapsed ? 'Expand sidebar' : 'Collapse sidebar'" aria-label="Toggle sidebar"
                        class="hidden rounded-xl border border-stone-900/15 bg-white p-2.5 text-stone-600 shadow-sm transition hover:bg-stone-100 md:inline-flex">
                        <span x-show="!sidebarCollapsed"><i data-lucide="chevrons-left" class="h-5 w-5"></i></span>
                        <span x-show="sidebarCollapsed" x-cloak><i data-lucide="chevrons-right" class="h-5 w-5"></i></span>
                    </button>
                    <div class="min-w-0 flex-1 px-1">
                        <p class="truncate text-sm font-extrabold text-stone-900">@yield('title', 'Dashboard')</p>
                        <p class="hidden text-[11px] font-bold uppercase tracking-[0.14em] text-orange-700 sm:block">Personal Learning Tracker</p>
                    </div>
                    <span class="hidden items-center gap-1.5 rounded-full border border-stone-900/15 px-3 py-1.5 text-xs font-bold text-stone-500 lg:inline-flex">
                        <i data-lucide="flame" class="h-3.5 w-3.5 text-orange-700"></i>
                        Laravel {{ app()->version() }}
                    </span>
                </div>
            </header>

            <main class="mx-auto w-full max-w-7xl flex-1 px-4 py-8 sm:px-6 lg:px-8">
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
                <div class="mx-auto flex w-full max-w-7xl flex-col gap-2 px-4 py-6 text-xs text-stone-500 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
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
        </div>
    </div>

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

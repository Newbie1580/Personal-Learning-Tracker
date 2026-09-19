@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero -->
<div class="anim-rise relative overflow-hidden rounded-3xl bg-green-950 px-6 py-10 shadow-xl shadow-green-950/25 sm:px-10">
    <div class="pointer-events-none absolute inset-0">
        <div class="anim-drift absolute -right-24 -top-24 h-72 w-72 rounded-full bg-orange-700/25 blur-3xl"></div>
        <div class="anim-drift-slow absolute -bottom-28 -left-16 h-72 w-72 rounded-full bg-amber-200/10 blur-3xl"></div>
        <div class="absolute inset-0 opacity-[0.12]" style="background-image: radial-gradient(circle at 1px 1px, #f5f1e8 1px, transparent 0); background-size: 22px 22px;"></div>
    </div>
    <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
        <div class="max-w-xl">
            <p class="inline-flex items-center gap-1.5 rounded-full bg-amber-100/10 px-3 py-1 text-[11px] font-bold uppercase tracking-[0.14em] text-amber-200 ring-1 ring-amber-100/20">
                <span class="anim-dot h-1.5 w-1.5 rounded-full bg-amber-400"></span> ITE 311 &middot; Lab 4 MVC CRUD
            </p>
            <h1 class="mt-4 text-3xl font-semibold tracking-tight text-amber-50 sm:text-4xl">Your learning, kept like a well-worn notebook.</h1>
            <p class="mt-2 text-sm leading-relaxed text-green-100/70">Categories, resources, skills, goals and study sessions — full CRUD, filters and seed data across five tables.</p>
            <div class="mt-5 flex flex-wrap gap-3">
                <a href="{{ route('learning-resources.create') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-orange-700 px-4 py-2.5 text-sm font-bold text-amber-50 shadow-lg transition hover:bg-orange-800"><i data-lucide="plus" class="h-4 w-4"></i>New resource</a>
                <a href="{{ route('categories.create') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-amber-50/10 px-4 py-2.5 text-sm font-bold text-amber-50 ring-1 ring-amber-50/25 transition hover:bg-amber-50/20"><i data-lucide="tags" class="h-4 w-4"></i>Category</a>
                <a href="{{ route('skills.create') }}" class="inline-flex items-center gap-1.5 rounded-xl bg-amber-50/10 px-4 py-2.5 text-sm font-bold text-amber-50 ring-1 ring-amber-50/25 transition hover:bg-amber-50/20"><i data-lucide="sparkles" class="h-4 w-4"></i>Skill</a>
            </div>
        </div>
        <div class="w-full max-w-sm rounded-2xl border border-amber-50/15 bg-amber-50/5 p-5 backdrop-blur">
            <div class="flex items-center justify-between">
                <p class="text-xs font-bold uppercase tracking-[0.14em] text-amber-200/80">Completion</p>
                <p class="text-2xl font-extrabold text-amber-50"><span data-count="{{ $completionRate }}">0</span><span class="text-sm font-bold text-amber-200/70">%</span></p>
            </div>
            <div class="mt-3 h-2.5 overflow-hidden rounded-full bg-amber-50/15">
                <div class="anim-bar h-full rounded-full bg-amber-400" style="--w: {{ $completionRate }}%"></div>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-3 text-center">
                <div class="rounded-xl bg-amber-50/5 px-3 py-3 ring-1 ring-amber-50/10">
                    <p class="text-xl font-extrabold text-amber-50"><span data-count="{{ $completedCount }}">0</span></p>
                    <p class="text-[11px] font-bold uppercase tracking-wide text-amber-200/70">Completed</p>
                </div>
                <div class="rounded-xl bg-amber-50/5 px-3 py-3 ring-1 ring-amber-50/10">
                    <p class="text-xl font-extrabold text-amber-50"><span data-count="{{ $studyMinutes }}">0</span></p>
                    <p class="text-[11px] font-bold uppercase tracking-wide text-amber-200/70">Study mins</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stat cards -->
<div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
    <a href="{{ route('categories.index') }}" class="lift anim-rise rounded-3xl border border-stone-900/10 bg-white p-5 shadow-sm" style="animation-delay:60ms">
        <div class="flex items-center justify-between">
            <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-orange-100 text-orange-800">
                <i data-lucide="tags" class="h-5 w-5"></i>
            </span>
            <span class="inline-flex items-center gap-1 text-xs font-bold text-orange-700">Manage <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i></span>
        </div>
        <p class="mt-4 text-3xl font-extrabold text-stone-900"><span data-count="{{ $categoryCount }}">0</span></p>
        <p class="text-xs font-bold uppercase tracking-[0.14em] text-stone-400">Categories</p>
    </a>
    <a href="{{ route('learning-resources.index') }}" class="lift anim-rise rounded-3xl border border-stone-900/10 bg-white p-5 shadow-sm" style="animation-delay:140ms">
        <div class="flex items-center justify-between">
            <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-green-900 text-amber-100">
                <i data-lucide="book-open" class="h-5 w-5"></i>
            </span>
            <span class="inline-flex items-center gap-1 text-xs font-bold text-green-900">Manage <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i></span>
        </div>
        <p class="mt-4 text-3xl font-extrabold text-stone-900"><span data-count="{{ $resourceCount }}">0</span></p>
        <p class="text-xs font-bold uppercase tracking-[0.14em] text-stone-400">Resources</p>
    </a>
    <a href="{{ route('skills.index') }}" class="lift anim-rise rounded-3xl border border-stone-900/10 bg-white p-5 shadow-sm" style="animation-delay:220ms">
        <div class="flex items-center justify-between">
            <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-amber-100 text-amber-800">
                <i data-lucide="sparkles" class="h-5 w-5"></i>
            </span>
            <span class="inline-flex items-center gap-1 text-xs font-bold text-amber-700">Manage <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i></span>
        </div>
        <p class="mt-4 text-3xl font-extrabold text-stone-900"><span data-count="{{ $skillCount }}">0</span></p>
        <p class="text-xs font-bold uppercase tracking-[0.14em] text-stone-400">Skills</p>
    </a>
    <div class="anim-rise rounded-3xl border border-stone-900/10 bg-white p-5 shadow-sm" style="animation-delay:300ms">
        <div class="flex items-center justify-between">
            <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-stone-900 text-amber-100">
                <i data-lucide="target" class="h-5 w-5"></i>
            </span>
            <span class="rounded-full bg-stone-100 px-2.5 py-1 text-[11px] font-bold text-stone-500">Seeded</span>
        </div>
        <p class="mt-4 text-3xl font-extrabold text-stone-900"><span data-count="{{ $goalCount }}">0</span></p>
        <p class="text-xs font-bold uppercase tracking-[0.14em] text-stone-400">Goals</p>
    </div>
</div>

<!-- Recents -->
<div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
    <div class="anim-rise overflow-hidden rounded-3xl border border-stone-900/10 bg-white shadow-sm" style="animation-delay:180ms">
        <div class="flex items-center justify-between border-b border-stone-100 px-6 py-4">
            <div>
                <h2 class="font-display text-lg font-semibold text-stone-900">Recent Learning Resources</h2>
                <p class="text-xs text-stone-400">Latest additions to your shelf</p>
            </div>
            <a href="{{ route('learning-resources.index') }}" class="rounded-xl bg-orange-50 px-3 py-1.5 text-xs font-bold text-orange-700 transition hover:bg-orange-100">View all</a>
        </div>
        <ul class="divide-y divide-stone-100/70">
            @forelse ($recentResources as $resource)
                <li>
                    <a href="{{ route('learning-resources.show', $resource) }}" class="group flex items-center gap-3 px-6 py-3.5 transition hover:bg-orange-50/50">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-green-900 text-xs font-extrabold text-amber-100">{{ strtoupper(substr($resource->title, 0, 1)) }}</span>
                        <span class="min-w-0 flex-1">
                            <span class="block truncate text-sm font-bold text-stone-900">{{ $resource->title }}</span>
                            <span class="block text-xs text-stone-400">{{ $resource->category?->name ?? '—' }} &middot; {{ ucfirst($resource->type) }}</span>
                        </span>
                        @if ($resource->status === 'completed')
                            <span class="shrink-0 rounded-full bg-green-900/10 px-2.5 py-1 text-[11px] font-bold text-green-900">Completed</span>
                        @elseif ($resource->status === 'in_progress')
                            <span class="shrink-0 rounded-full bg-amber-100 px-2.5 py-1 text-[11px] font-bold text-amber-800">In progress</span>
                        @else
                            <span class="shrink-0 rounded-full bg-stone-100 px-2.5 py-1 text-[11px] font-bold text-stone-500">Not started</span>
                        @endif
                    </a>
                </li>
            @empty
                <li class="px-6 py-8 text-center text-sm text-stone-400">No resources yet. <a class="font-bold text-orange-700 hover:underline" href="{{ route('learning-resources.create') }}">Add one</a>.</li>
            @endforelse
        </ul>
    </div>

    <div class="anim-rise overflow-hidden rounded-3xl border border-stone-900/10 bg-white shadow-sm" style="animation-delay:260ms">
        <div class="border-b border-stone-100 px-6 py-4">
            <h2 class="font-display text-lg font-semibold text-stone-900">Recent Study Sessions</h2>
            <p class="text-xs text-stone-400">Your latest logged focus time</p>
        </div>
        <ul class="divide-y divide-stone-100/70">
            @forelse ($recentLogs as $log)
                <li class="flex items-center gap-3 px-6 py-3.5">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-stone-900 text-amber-100">
                        <i data-lucide="clock" class="h-4 w-4"></i>
                    </span>
                    <span class="min-w-0 flex-1">
                        <span class="block truncate text-sm font-bold text-stone-900">{{ $log->learningResource?->title ?? 'Deleted resource' }}</span>
                        <span class="block text-xs text-stone-400">{{ $log->logged_on?->format('M d, Y') }}</span>
                    </span>
                    <span class="shrink-0 rounded-full bg-orange-700 px-3 py-1 text-[11px] font-extrabold text-amber-50">{{ $log->duration_minutes }}m</span>
                </li>
            @empty
                <li class="px-6 py-8 text-center text-sm text-stone-400">No study logs seeded yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

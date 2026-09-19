@extends('layouts.app')

@section('title', $resource->title)

@section('content')
<div class="mx-auto max-w-3xl">
    <a href="{{ route('learning-resources.index') }}" class="anim-rise inline-flex items-center gap-1.5 text-sm font-bold text-orange-700 hover:underline">
        <i data-lucide="arrow-left" class="h-4 w-4"></i>
        Back to resources
    </a>

    <div class="anim-rise mt-4 overflow-hidden rounded-3xl border border-stone-900/10 bg-white shadow-sm" style="animation-delay:80ms">
        <div class="h-1.5 bg-orange-700"></div>
        <div class="p-6 sm:p-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div class="flex items-start gap-4">
                    <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-green-900 text-xl font-extrabold text-amber-100 shadow-md">{{ strtoupper(substr($resource->title, 0, 1)) }}</span>
                    <div>
                        <h1 class="text-3xl font-semibold tracking-tight text-stone-900">{{ $resource->title }}</h1>
                        <p class="mt-1 text-sm text-stone-500">{{ $resource->category?->name ?? 'No category' }} &middot; {{ ucfirst($resource->type) }}</p>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @if ($resource->status === 'completed')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-900/10 px-3 py-1 text-xs font-bold text-green-900"><span class="h-1.5 w-1.5 rounded-full bg-green-700"></span>Completed</span>
                            @elseif ($resource->status === 'in_progress')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-800"><span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>In progress</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-stone-100 px-3 py-1 text-xs font-bold text-stone-500"><span class="h-1.5 w-1.5 rounded-full bg-stone-400"></span>Not started</span>
                            @endif
                            <span class="rounded-full bg-stone-100 px-3 py-1 text-xs font-bold text-stone-600">{{ ucfirst($resource->type) }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex shrink-0 gap-2">
                    <a href="{{ route('learning-resources.edit', $resource) }}" class="inline-flex items-center gap-1.5 rounded-xl border border-stone-900/15 px-3.5 py-2 text-sm font-bold text-stone-600 transition hover:bg-stone-100"><i data-lucide="pencil" class="h-4 w-4"></i>Edit</a>
                    <button type="button" @click="$dispatch('open-delete', { action: '{{ route('learning-resources.destroy', $resource) }}', name: '{{ addslashes($resource->title) }}' })" class="inline-flex items-center gap-1.5 rounded-xl bg-red-800 px-3.5 py-2 text-sm font-bold text-amber-50 transition hover:bg-red-900"><i data-lucide="trash-2" class="h-4 w-4"></i>Delete</button>
                </div>
            </div>

            @if ($resource->description)
                <p class="mt-5 rounded-2xl bg-stone-100/70 p-4 text-sm leading-relaxed text-stone-600">{{ $resource->description }}</p>
            @endif

            <div class="mt-4 flex flex-wrap items-center gap-3 text-sm">
                @if ($resource->url)
                    <a href="{{ $resource->url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 rounded-xl bg-green-900 px-4 py-2 text-xs font-bold text-amber-50 shadow-md transition hover:bg-green-950">Open resource
                        <i data-lucide="external-link" class="h-3.5 w-3.5"></i>
                    </a>
                @endif
                <span class="text-xs text-stone-400">Created {{ $resource->created_at?->format('M d, Y') }} &middot; Updated {{ $resource->updated_at?->format('M d, Y') }}</span>
            </div>
        </div>
    </div>

    <div class="anim-rise mt-6 overflow-hidden rounded-3xl border border-stone-900/10 bg-white shadow-sm" style="animation-delay:160ms">
        <div class="flex items-center justify-between border-b border-stone-100 px-6 py-4">
            <h2 class="font-display text-lg font-semibold text-stone-900">Study sessions</h2>
            <span class="rounded-full bg-orange-50 px-2.5 py-1 text-xs font-extrabold text-orange-700">{{ $resource->learningLogs->count() }}</span>
        </div>
        <ul class="divide-y divide-stone-100/70">
            @forelse ($resource->learningLogs as $log)
                <li class="flex items-center justify-between gap-3 px-6 py-3.5 text-sm">
                    <span class="flex min-w-0 items-center gap-3">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-stone-100 text-stone-500"><i data-lucide="clock" class="h-4 w-4"></i></span>
                        <span class="min-w-0">
                            <span class="block font-bold text-stone-800">{{ $log->logged_on?->format('M d, Y') }}</span>
                            <span class="block truncate text-xs text-stone-400">{{ $log->notes ?? 'No notes' }}</span>
                        </span>
                    </span>
                    <span class="shrink-0 rounded-full bg-stone-900 px-3 py-1 text-[11px] font-extrabold text-amber-50">{{ $log->duration_minutes }} min</span>
                </li>
            @empty
                <li class="px-6 py-8 text-center text-sm text-stone-400">No study logs yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

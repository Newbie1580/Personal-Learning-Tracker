@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="mx-auto max-w-3xl">
    <a href="{{ route('categories.index') }}" class="anim-rise inline-flex items-center gap-1.5 text-sm font-bold text-orange-700 hover:underline">
        <i data-lucide="arrow-left" class="h-4 w-4"></i>
        Back to categories
    </a>

    <div class="anim-rise relative mt-4 overflow-hidden rounded-3xl border border-stone-900/10 bg-white p-6 shadow-sm sm:p-8" style="animation-delay:80ms">
        <div class="absolute inset-x-0 top-0 h-1.5" style="background: {{ $category->color }}"></div>
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div class="flex items-start gap-4">
                <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl text-xl font-extrabold text-white shadow-md" style="background: {{ $category->color }}">{{ strtoupper(substr($category->name, 0, 1)) }}</span>
                <div>
                    <h1 class="text-3xl font-semibold tracking-tight text-stone-900">{{ $category->name }}</h1>
                    <p class="mt-1 text-sm text-stone-500">{{ $category->description ?? 'No description.' }}</p>
                    <p class="mt-2 text-xs text-stone-400">{{ $category->learningResources->count() }} resources &middot; Updated {{ $category->updated_at?->format('M d, Y') }}</p>
                </div>
            </div>
            <div class="flex shrink-0 gap-2">
                <a href="{{ route('categories.edit', $category) }}" class="inline-flex items-center gap-1.5 rounded-xl border border-stone-900/15 px-3.5 py-2 text-sm font-bold text-stone-600 transition hover:bg-stone-100">
                    <i data-lucide="pencil" class="h-4 w-4"></i>
                    Edit
                </a>
                <button type="button" @click="$dispatch('open-delete', { action: '{{ route('categories.destroy', $category) }}', name: '{{ addslashes($category->name) }}' })" class="inline-flex items-center gap-1.5 rounded-xl bg-red-800 px-3.5 py-2 text-sm font-bold text-amber-50 transition hover:bg-red-900">
                    <i data-lucide="trash-2" class="h-4 w-4"></i>
                    Delete
                </button>
            </div>
        </div>
    </div>

    <div class="anim-rise mt-6 overflow-hidden rounded-3xl border border-stone-900/10 bg-white shadow-sm" style="animation-delay:160ms">
        <div class="border-b border-stone-100 px-6 py-4">
            <h2 class="font-display text-lg font-semibold text-stone-900">Learning resources in this category</h2>
        </div>
        <ul class="divide-y divide-stone-100/70">
            @forelse ($category->learningResources as $resource)
                <li>
                    <a href="{{ route('learning-resources.show', $resource) }}" class="flex items-center justify-between gap-3 px-6 py-3.5 transition hover:bg-orange-50/50">
                        <span class="text-sm font-bold text-stone-800">{{ $resource->title }}</span>
                        <span class="inline-flex items-center gap-1 text-xs font-bold text-orange-700">View <i data-lucide="arrow-right" class="h-3.5 w-3.5"></i></span>
                    </a>
                </li>
            @empty
                <li class="px-6 py-8 text-center text-sm text-stone-400">No resources yet.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

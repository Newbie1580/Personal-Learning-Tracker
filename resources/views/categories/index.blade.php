@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="anim-rise mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div class="flex items-center gap-4">
        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-700 text-amber-50 shadow-md">
            <i data-lucide="tags" class="h-6 w-6"></i>
        </span>
        <div>
            <h1 class="text-3xl font-semibold tracking-tight text-stone-900">Categories</h1>
            <p class="text-sm text-stone-500"><span class="font-bold text-orange-700">{{ $categories->total() }}</span> total &middot; full CRUD</p>
        </div>
    </div>
    <a href="{{ route('categories.create') }}" class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-orange-700 px-4 py-2.5 text-sm font-bold text-amber-50 shadow-md transition hover:bg-orange-800">
        <i data-lucide="plus" class="h-4 w-4"></i>
        New category
    </a>
</div>

<form method="GET" action="{{ route('categories.index') }}" class="anim-rise mb-5 flex flex-col gap-2 rounded-2xl border border-stone-900/10 bg-white p-3 shadow-sm" style="animation-delay:80ms">
    <div class="flex flex-col gap-2 sm:flex-row">
        <div class="relative flex-1">
            <i data-lucide="search" class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-stone-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search categories..." class="w-full rounded-xl border-0 bg-stone-100 py-2.5 pl-10 pr-3 text-sm text-stone-800 placeholder:text-stone-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">
        </div>
        <div class="flex gap-2">
            <button class="flex-1 rounded-xl bg-stone-900 px-5 py-2.5 text-sm font-bold text-amber-50 transition hover:bg-stone-800 sm:flex-none">Search</button>
            @if(request('search'))
                <a href="{{ route('categories.index') }}" class="rounded-xl px-3 py-2.5 text-sm font-semibold text-stone-400 transition hover:text-stone-600">Clear</a>
            @endif
        </div>
    </div>
</form>

<div class="anim-rise overflow-hidden rounded-3xl border border-stone-900/10 bg-white shadow-sm" style="animation-delay:140ms">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-stone-100 text-sm">
            <thead>
                <tr class="bg-stone-50 text-left text-[11px] font-bold uppercase tracking-[0.12em] text-stone-400">
                    <th class="px-6 py-3.5">Category</th>
                    <th class="px-6 py-3.5">Description</th>
                    <th class="px-6 py-3.5">Resources</th>
                    <th class="px-6 py-3.5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100/70">
                @forelse ($categories as $category)
                    <tr class="table-row hover:bg-orange-50/50">
                        <td class="px-6 py-4">
                            <span class="flex items-center gap-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-xs font-extrabold text-white shadow-sm" style="background: {{ $category->color }}">{{ strtoupper(substr($category->name, 0, 1)) }}</span>
                                <span class="font-bold text-stone-900">{{ $category->name }}</span>
                            </span>
                        </td>
                        <td class="max-w-xs truncate px-6 py-4 text-stone-500">{{ $category->description ?? '—' }}</td>
                        <td class="px-6 py-4"><span class="rounded-full bg-green-900/10 px-2.5 py-1 text-xs font-extrabold text-green-900">{{ $category->learning_resources_count }}</span></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('categories.show', $category) }}" title="View" class="rounded-lg p-2 text-stone-400 transition hover:bg-orange-50 hover:text-orange-700">
                                    <i data-lucide="eye" class="h-5 w-5"></i>
                                </a>
                                <a href="{{ route('categories.edit', $category) }}" title="Edit" class="rounded-lg p-2 text-stone-400 transition hover:bg-amber-50 hover:text-amber-700">
                                    <i data-lucide="pencil" class="h-5 w-5"></i>
                                </a>
                                <button type="button" title="Delete" @click="$dispatch('open-delete', { action: '{{ route('categories.destroy', $category) }}', name: '{{ addslashes($category->name) }}' })" class="rounded-lg p-2 text-stone-400 transition hover:bg-red-50 hover:text-red-800">
                                    <i data-lucide="trash-2" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-14 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-50 text-orange-300">
                                <i data-lucide="search" class="h-6 w-6"></i>
                            </div>
                            <p class="mt-3 text-sm font-bold text-stone-700">No categories found</p>
                            <p class="mt-1 text-xs text-stone-400">Try a different search or create a new one.</p>
                            <a href="{{ route('categories.create') }}" class="mt-4 inline-flex items-center gap-1.5 rounded-xl bg-orange-700 px-4 py-2 text-xs font-bold text-amber-50 transition hover:bg-orange-800"><i data-lucide="plus" class="h-3.5 w-3.5"></i>New category</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($categories->hasPages() || $categories->total() > 0)
        <div class="flex flex-col gap-3 border-t border-stone-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs text-stone-400">Showing <span class="font-bold text-stone-600">{{ $categories->firstItem() ?? 0 }}–{{ $categories->lastItem() ?? 0 }}</span> of <span class="font-bold text-stone-600">{{ $categories->total() }}</span></p>
            <div>{{ $categories->links() }}</div>
        </div>
    @endif
</div>
@endsection

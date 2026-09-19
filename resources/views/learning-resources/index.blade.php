@extends('layouts.app')

@section('title', 'Learning Resources')

@section('content')
<div class="anim-rise mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div class="flex items-center gap-4">
        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-900 text-amber-100 shadow-md">
            <i data-lucide="book-open" class="h-6 w-6"></i>
        </span>
        <div>
            <h1 class="text-3xl font-semibold tracking-tight text-stone-900">Learning Resources</h1>
            <p class="text-sm text-stone-500"><span class="font-bold text-green-900">{{ $resources->total() }}</span> total &middot; full CRUD</p>
        </div>
    </div>
    <a href="{{ route('learning-resources.create') }}" class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-orange-700 px-4 py-2.5 text-sm font-bold text-amber-50 shadow-md transition hover:bg-orange-800">
        <i data-lucide="plus" class="h-4 w-4"></i>
        New resource
    </a>
</div>

<form method="GET" action="{{ route('learning-resources.index') }}" class="anim-rise mb-5 rounded-2xl border border-stone-900/10 bg-white p-3 shadow-sm" style="animation-delay:80ms">
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 lg:grid-cols-6">
        <div class="relative lg:col-span-2">
            <i data-lucide="search" class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-stone-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search title or description..." class="w-full rounded-xl border-0 bg-stone-100 py-2.5 pl-10 pr-3 text-sm text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">
        </div>
        <select name="category_id" class="rounded-xl border-0 bg-stone-100 px-3 py-2.5 text-sm font-medium text-stone-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">
            <option value="">All categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <select name="type" class="rounded-xl border-0 bg-stone-100 px-3 py-2.5 text-sm font-medium text-stone-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">
            <option value="">All types</option>
            @foreach ($types as $type)
                <option value="{{ $type }}" @selected(request('type') === $type)>{{ ucfirst($type) }}</option>
            @endforeach
        </select>
        <select name="status" class="rounded-xl border-0 bg-stone-100 px-3 py-2.5 text-sm font-medium text-stone-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">
            <option value="">All statuses</option>
            @foreach ($statuses as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ str_replace('_', ' ', ucfirst($status)) }}</option>
            @endforeach
        </select>
        <div class="flex gap-2">
            <button class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-xl bg-stone-900 px-4 py-2.5 text-sm font-bold text-amber-50 transition hover:bg-stone-800"><i data-lucide="list-filter" class="h-4 w-4"></i>Filter</button>
            <a href="{{ route('learning-resources.index') }}" class="rounded-xl px-3 py-2.5 text-sm font-semibold text-stone-400 transition hover:text-stone-600">Reset</a>
        </div>
    </div>
</form>

<div class="anim-rise overflow-hidden rounded-3xl border border-stone-900/10 bg-white shadow-sm" style="animation-delay:140ms">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-stone-100 text-sm">
            <thead>
                <tr class="bg-stone-50 text-left text-[11px] font-bold uppercase tracking-[0.12em] text-stone-400">
                    <th class="px-6 py-3.5">Title</th>
                    <th class="px-6 py-3.5">Category</th>
                    <th class="px-6 py-3.5">Type</th>
                    <th class="px-6 py-3.5">Status</th>
                    <th class="px-6 py-3.5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100/70">
                @forelse ($resources as $resource)
                    <tr class="table-row hover:bg-orange-50/50">
                        <td class="max-w-xs px-6 py-4">
                            <p class="truncate font-bold text-stone-900">{{ $resource->title }}</p>
                            <p class="truncate text-xs text-stone-400">{{ $resource->url ?? $resource->description }}</p>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            @if ($resource->category)
                                <span class="inline-flex items-center gap-1.5 text-stone-600"><span class="h-2.5 w-2.5 rounded-full" style="background: {{ $resource->category->color }}"></span>{{ $resource->category->name }}</span>
                            @else
                                <span class="text-stone-300">—</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4"><span class="rounded-full bg-stone-100 px-2.5 py-1 text-xs font-bold text-stone-600">{{ ucfirst($resource->type) }}</span></td>
                        <td class="whitespace-nowrap px-6 py-4">
                            @if ($resource->status === 'completed')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-900/10 px-2.5 py-1 text-xs font-bold text-green-900"><span class="anim-dot h-1.5 w-1.5 rounded-full bg-green-700"></span>Completed</span>
                            @elseif ($resource->status === 'in_progress')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-800"><span class="anim-dot h-1.5 w-1.5 rounded-full bg-amber-500"></span>In progress</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-stone-100 px-2.5 py-1 text-xs font-bold text-stone-500"><span class="h-1.5 w-1.5 rounded-full bg-stone-400"></span>Not started</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('learning-resources.show', $resource) }}" title="View" class="rounded-lg p-2 text-stone-400 transition hover:bg-orange-50 hover:text-orange-700">
                                    <i data-lucide="eye" class="h-5 w-5"></i>
                                </a>
                                <a href="{{ route('learning-resources.edit', $resource) }}" title="Edit" class="rounded-lg p-2 text-stone-400 transition hover:bg-amber-50 hover:text-amber-700">
                                    <i data-lucide="pencil" class="h-5 w-5"></i>
                                </a>
                                <button type="button" title="Delete" @click="$dispatch('open-delete', { action: '{{ route('learning-resources.destroy', $resource) }}', name: '{{ addslashes($resource->title) }}' })" class="rounded-lg p-2 text-stone-400 transition hover:bg-red-50 hover:text-red-800">
                                    <i data-lucide="trash-2" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-14 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-green-900/5 text-green-900/40">
                                <i data-lucide="book-open" class="h-6 w-6"></i>
                            </div>
                            <p class="mt-3 text-sm font-bold text-stone-700">No resources found</p>
                            <p class="mt-1 text-xs text-stone-400">Adjust your filters or add a new resource.</p>
                            <a href="{{ route('learning-resources.create') }}" class="mt-4 inline-flex items-center gap-1.5 rounded-xl bg-orange-700 px-4 py-2 text-xs font-bold text-amber-50 transition hover:bg-orange-800"><i data-lucide="plus" class="h-3.5 w-3.5"></i>New resource</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($resources->hasPages() || $resources->total() > 0)
        <div class="flex flex-col gap-3 border-t border-stone-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs text-stone-400">Showing <span class="font-bold text-stone-600">{{ $resources->firstItem() ?? 0 }}–{{ $resources->lastItem() ?? 0 }}</span> of <span class="font-bold text-stone-600">{{ $resources->total() }}</span></p>
            <div>{{ $resources->links() }}</div>
        </div>
    @endif
</div>
@endsection

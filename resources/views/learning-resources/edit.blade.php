@extends('layouts.app')

@section('title', 'Edit Resource')

@section('content')
<div class="mx-auto max-w-2xl">
    <a href="{{ route('learning-resources.index') }}" class="anim-rise inline-flex items-center gap-1.5 text-sm font-bold text-orange-700 hover:underline">
        <i data-lucide="arrow-left" class="h-4 w-4"></i>
        Back to resources
    </a>
    <div class="anim-rise mt-3 flex items-center gap-4" style="animation-delay:60ms">
        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-900 text-lg font-extrabold text-amber-100 shadow-md">{{ strtoupper(substr($resource->title, 0, 1)) }}</span>
        <div>
            <h1 class="text-3xl font-semibold tracking-tight text-stone-900">Edit Resource</h1>
            <p class="truncate text-sm text-stone-500">Updating <span class="font-bold text-stone-700">{{ $resource->title }}</span>.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('learning-resources.update', $resource) }}" class="anim-rise mt-6 overflow-hidden rounded-3xl border border-stone-900/10 bg-white shadow-sm" style="animation-delay:120ms">
        @csrf
        @method('PUT')
        <div class="space-y-5 p-6 sm:p-8">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-bold text-stone-700">Title <span class="text-orange-700">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $resource->title) }}" required maxlength="255" class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm font-medium text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700 @error('title') ring-2 ring-red-700 @enderror">
                    @error('title')<p class="mt-1 text-xs font-semibold text-red-800">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-stone-700">Category <span class="text-orange-700">*</span></label>
                    <select name="category_id" required class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm font-medium text-stone-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $resource->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-stone-700">URL</label>
                    <input type="url" name="url" value="{{ old('url', $resource->url) }}" maxlength="255" class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700 @error('url') ring-2 ring-red-700 @enderror">
                    @error('url')<p class="mt-1 text-xs font-semibold text-red-800">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-stone-700">Type <span class="text-orange-700">*</span></label>
                    <select name="type" required class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm font-medium text-stone-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">
                        @foreach ($types as $type)
                            <option value="{{ $type }}" @selected(old('type', $resource->type) === $type)>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-stone-700">Status <span class="text-orange-700">*</span></label>
                    <select name="status" required class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm font-medium text-stone-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" @selected(old('status', $resource->status) === $status)>{{ str_replace('_', ' ', ucfirst($status)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-bold text-stone-700">Description</label>
                    <textarea name="description" rows="4" class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">{{ old('description', $resource->description) }}</textarea>
                </div>
            </div>
        </div>
        <div class="flex flex-col-reverse gap-2 border-t border-stone-100 bg-stone-50 px-6 py-4 sm:flex-row sm:justify-end sm:px-8">
            <a href="{{ route('learning-resources.index') }}" class="rounded-xl px-5 py-2.5 text-center text-sm font-bold text-stone-500 transition hover:bg-stone-100">Cancel</a>
            <button class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-orange-700 px-6 py-2.5 text-sm font-bold text-amber-50 shadow-md transition hover:bg-orange-800"><i data-lucide="check" class="h-4 w-4"></i>Update resource</button>
        </div>
    </form>
</div>
@endsection

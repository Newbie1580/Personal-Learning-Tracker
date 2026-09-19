@extends('layouts.app')

@section('title', 'New Resource')

@section('content')
<div class="mx-auto max-w-2xl">
    <a href="{{ route('learning-resources.index') }}" class="anim-rise inline-flex items-center gap-1.5 text-sm font-bold text-orange-700 hover:underline">
        <i data-lucide="arrow-left" class="h-4 w-4"></i>
        Back to resources
    </a>
    <div class="anim-rise mt-3 flex items-center gap-4" style="animation-delay:60ms">
        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-900 text-amber-100 shadow-md">
            <i data-lucide="plus" class="h-6 w-6"></i>
        </span>
        <div>
            <h1 class="text-3xl font-semibold tracking-tight text-stone-900">Create Learning Resource</h1>
            <p class="text-sm text-stone-500">Save an article, video, course, book or tutorial.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('learning-resources.store') }}" class="anim-rise mt-6 overflow-hidden rounded-3xl border border-stone-900/10 bg-white shadow-sm" style="animation-delay:120ms">
        @csrf
        <div class="space-y-5 p-6 sm:p-8">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-bold text-stone-700">Title <span class="text-orange-700">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required maxlength="255" placeholder="e.g. Laravel Bootcamp — Build Chirper" class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm font-medium text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700 @error('title') ring-2 ring-red-700 @enderror">
                    @error('title')<p class="mt-1 text-xs font-semibold text-red-800">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-stone-700">Category <span class="text-orange-700">*</span></label>
                    <select name="category_id" required class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm font-medium text-stone-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700 @error('category_id') ring-2 ring-red-700 @enderror">
                        <option value="">Select category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<p class="mt-1 text-xs font-semibold text-red-800">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-stone-700">URL</label>
                    <input type="url" name="url" value="{{ old('url') }}" maxlength="255" placeholder="https://..." class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700 @error('url') ring-2 ring-red-700 @enderror">
                    @error('url')<p class="mt-1 text-xs font-semibold text-red-800">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-stone-700">Type <span class="text-orange-700">*</span></label>
                    <select name="type" required class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm font-medium text-stone-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">
                        @foreach ($types as $type)
                            <option value="{{ $type }}" @selected(old('type') === $type)>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-stone-700">Status <span class="text-orange-700">*</span></label>
                    <select name="status" required class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm font-medium text-stone-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" @selected(old('status') === $status)>{{ str_replace('_', ' ', ucfirst($status)) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-sm font-bold text-stone-700">Description</label>
                    <textarea name="description" rows="4" placeholder="What will you learn from this?" class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>
        <div class="flex flex-col-reverse gap-2 border-t border-stone-100 bg-stone-50 px-6 py-4 sm:flex-row sm:justify-end sm:px-8">
            <a href="{{ route('learning-resources.index') }}" class="rounded-xl px-5 py-2.5 text-center text-sm font-bold text-stone-500 transition hover:bg-stone-100">Cancel</a>
            <button class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-orange-700 px-6 py-2.5 text-sm font-bold text-amber-50 shadow-md transition hover:bg-orange-800"><i data-lucide="check" class="h-4 w-4"></i>Save resource</button>
        </div>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Edit Skill')

@section('content')
<div class="mx-auto max-w-2xl">
    <a href="{{ route('skills.index') }}" class="anim-rise inline-flex items-center gap-1.5 text-sm font-bold text-orange-700 hover:underline">
        <i data-lucide="arrow-left" class="h-4 w-4"></i>
        Back to skills
    </a>
    <div class="anim-rise mt-3 flex items-center gap-4" style="animation-delay:60ms">
        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-stone-900 text-lg font-extrabold text-amber-100 shadow-md">{{ strtoupper(substr($skill->name, 0, 1)) }}</span>
        <div>
            <h1 class="text-3xl font-semibold tracking-tight text-stone-900">Edit Skill</h1>
            <p class="text-sm text-stone-500">Updating <span class="font-bold text-stone-700">{{ $skill->name }}</span>.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('skills.update', $skill) }}" class="anim-rise mt-6 overflow-hidden rounded-3xl border border-stone-900/10 bg-white shadow-sm" style="animation-delay:120ms">
        @csrf
        @method('PUT')
        <div class="space-y-5 p-6 sm:p-8">
            <div>
                <label class="mb-1.5 block text-sm font-bold text-stone-700">Name <span class="text-orange-700">*</span></label>
                <input type="text" name="name" value="{{ old('name', $skill->name) }}" required maxlength="255" class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm font-medium text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700 @error('name') ring-2 ring-red-700 @enderror">
                @error('name')<p class="mt-1 text-xs font-semibold text-red-800">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="mb-1.5 block text-sm font-bold text-stone-700">Proficiency level <span class="text-orange-700">*</span></label>
                <div class="grid grid-cols-3 gap-2">
                    @foreach ($levels as $level)
                        <label class="cursor-pointer">
                            <input type="radio" name="proficiency_level" value="{{ $level }}" @checked(old('proficiency_level', $skill->proficiency_level) === $level) class="peer sr-only">
                            <span class="flex items-center justify-center gap-1.5 rounded-xl border-2 border-stone-100 bg-stone-50 px-3 py-2.5 text-center text-sm font-bold text-stone-500 transition peer-checked:border-green-900 peer-checked:bg-green-900 peer-checked:text-amber-50 hover:border-green-900/40"><i data-lucide="award" class="h-4 w-4"></i>{{ ucfirst($level) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
            <div>
                <label class="mb-1.5 block text-sm font-bold text-stone-700">Description</label>
                <textarea name="description" rows="3" class="w-full rounded-xl border-0 bg-stone-100 px-4 py-2.5 text-sm text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">{{ old('description', $skill->description) }}</textarea>
            </div>
        </div>
        <div class="flex flex-col-reverse gap-2 border-t border-stone-100 bg-stone-50 px-6 py-4 sm:flex-row sm:justify-end sm:px-8">
            <a href="{{ route('skills.index') }}" class="rounded-xl px-5 py-2.5 text-center text-sm font-bold text-stone-500 transition hover:bg-stone-100">Cancel</a>
            <button class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-orange-700 px-6 py-2.5 text-sm font-bold text-amber-50 shadow-md transition hover:bg-orange-800"><i data-lucide="check" class="h-4 w-4"></i>Update skill</button>
        </div>
    </form>
</div>
@endsection

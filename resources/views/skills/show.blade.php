@extends('layouts.app')

@section('title', $skill->name)

@section('content')
<div class="mx-auto max-w-3xl">
    <a href="{{ route('skills.index') }}" class="anim-rise inline-flex items-center gap-1.5 text-sm font-bold text-orange-700 hover:underline">
        <i data-lucide="arrow-left" class="h-4 w-4"></i>
        Back to skills
    </a>

    <div class="anim-rise mt-4 overflow-hidden rounded-3xl border border-stone-900/10 bg-white shadow-sm" style="animation-delay:80ms">
        <div class="h-1.5 bg-stone-900"></div>
        <div class="p-6 sm:p-8">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div class="flex items-start gap-4">
                    <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-stone-900 text-xl font-extrabold text-amber-100 shadow-md">{{ strtoupper(substr($skill->name, 0, 1)) }}</span>
                    <div>
                        <h1 class="text-3xl font-semibold tracking-tight text-stone-900">{{ $skill->name }}</h1>
                        <div class="mt-2">
                            @if ($skill->proficiency_level === 'advanced')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-900/10 px-3 py-1 text-xs font-bold text-green-900"><span class="h-1.5 w-1.5 rounded-full bg-green-700"></span>Advanced</span>
                            @elseif ($skill->proficiency_level === 'intermediate')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-800"><span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>Intermediate</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-orange-50 px-3 py-1 text-xs font-bold text-orange-800 ring-1 ring-orange-700/20"><span class="h-1.5 w-1.5 rounded-full bg-orange-600"></span>Beginner</span>
                            @endif
                        </div>
                        <p class="mt-3 text-sm leading-relaxed text-stone-600">{{ $skill->description ?? 'No description.' }}</p>
                        <p class="mt-3 text-xs text-stone-400">Created {{ $skill->created_at?->format('M d, Y') }} &middot; Updated {{ $skill->updated_at?->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="flex shrink-0 gap-2">
                    <a href="{{ route('skills.edit', $skill) }}" class="inline-flex items-center gap-1.5 rounded-xl border border-stone-900/15 px-3.5 py-2 text-sm font-bold text-stone-600 transition hover:bg-stone-100"><i data-lucide="pencil" class="h-4 w-4"></i>Edit</a>
                    <button type="button" @click="$dispatch('open-delete', { action: '{{ route('skills.destroy', $skill) }}', name: '{{ addslashes($skill->name) }}' })" class="inline-flex items-center gap-1.5 rounded-xl bg-red-800 px-3.5 py-2 text-sm font-bold text-amber-50 transition hover:bg-red-900"><i data-lucide="trash-2" class="h-4 w-4"></i>Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

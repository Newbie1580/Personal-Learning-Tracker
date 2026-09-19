@extends('layouts.app')

@section('title', 'Skills')

@section('content')
<div class="anim-rise mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div class="flex items-center gap-4">
        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-stone-900 text-amber-100 shadow-md">
            <i data-lucide="sparkles" class="h-6 w-6"></i>
        </span>
        <div>
            <h1 class="text-3xl font-semibold tracking-tight text-stone-900">Skills</h1>
            <p class="text-sm text-stone-500"><span class="font-bold text-stone-900">{{ $skills->total() }}</span> total &middot; full CRUD</p>
        </div>
    </div>
    <a href="{{ route('skills.create') }}" class="inline-flex items-center justify-center gap-1.5 rounded-xl bg-orange-700 px-4 py-2.5 text-sm font-bold text-amber-50 shadow-md transition hover:bg-orange-800">
        <i data-lucide="plus" class="h-4 w-4"></i>
        New skill
    </a>
</div>

<form method="GET" action="{{ route('skills.index') }}" class="anim-rise mb-5 rounded-2xl border border-stone-900/10 bg-white p-3 shadow-sm" style="animation-delay:80ms">
    <div class="grid grid-cols-1 gap-2 sm:grid-cols-4">
        <div class="relative sm:col-span-2">
            <i data-lucide="search" class="pointer-events-none absolute left-3.5 top-1/2 h-4 w-4 -translate-y-1/2 text-stone-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search skills..." class="w-full rounded-xl border-0 bg-stone-100 py-2.5 pl-10 pr-3 text-sm text-stone-800 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">
        </div>
        <select name="proficiency_level" class="rounded-xl border-0 bg-stone-100 px-3 py-2.5 text-sm font-medium text-stone-700 focus:bg-white focus:outline-none focus:ring-2 focus:ring-orange-700">
            <option value="">All levels</option>
            @foreach ($levels as $level)
                <option value="{{ $level }}" @selected(request('proficiency_level') === $level)>{{ ucfirst($level) }}</option>
            @endforeach
        </select>
        <div class="flex gap-2">
            <button class="inline-flex flex-1 items-center justify-center gap-1.5 rounded-xl bg-stone-900 px-4 py-2.5 text-sm font-bold text-amber-50 transition hover:bg-stone-800"><i data-lucide="list-filter" class="h-4 w-4"></i>Filter</button>
            <a href="{{ route('skills.index') }}" class="rounded-xl px-3 py-2.5 text-sm font-semibold text-stone-400 transition hover:text-stone-600">Reset</a>
        </div>
    </div>
</form>

<div class="anim-rise overflow-hidden rounded-3xl border border-stone-900/10 bg-white shadow-sm" style="animation-delay:140ms">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-stone-100 text-sm">
            <thead>
                <tr class="bg-stone-50 text-left text-[11px] font-bold uppercase tracking-[0.12em] text-stone-400">
                    <th class="px-6 py-3.5">Skill</th>
                    <th class="px-6 py-3.5">Level</th>
                    <th class="px-6 py-3.5">Description</th>
                    <th class="px-6 py-3.5 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-100/70">
                @forelse ($skills as $skill)
                    <tr class="table-row hover:bg-orange-50/50">
                        <td class="px-6 py-4">
                            <span class="flex items-center gap-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-stone-900 text-xs font-extrabold text-amber-100 shadow-sm">{{ strtoupper(substr($skill->name, 0, 1)) }}</span>
                                <span class="font-bold text-stone-900">{{ $skill->name }}</span>
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            @if ($skill->proficiency_level === 'advanced')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-green-900/10 px-2.5 py-1 text-xs font-bold text-green-900"><span class="h-1.5 w-1.5 rounded-full bg-green-700"></span>Advanced</span>
                            @elseif ($skill->proficiency_level === 'intermediate')
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-800"><span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>Intermediate</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-orange-50 px-2.5 py-1 text-xs font-bold text-orange-800 ring-1 ring-orange-700/20"><span class="h-1.5 w-1.5 rounded-full bg-orange-600"></span>Beginner</span>
                            @endif
                        </td>
                        <td class="max-w-xs truncate px-6 py-4 text-stone-500">{{ $skill->description ?? '—' }}</td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('skills.show', $skill) }}" title="View" class="rounded-lg p-2 text-stone-400 transition hover:bg-orange-50 hover:text-orange-700">
                                    <i data-lucide="eye" class="h-5 w-5"></i>
                                </a>
                                <a href="{{ route('skills.edit', $skill) }}" title="Edit" class="rounded-lg p-2 text-stone-400 transition hover:bg-amber-50 hover:text-amber-700">
                                    <i data-lucide="pencil" class="h-5 w-5"></i>
                                </a>
                                <button type="button" title="Delete" @click="$dispatch('open-delete', { action: '{{ route('skills.destroy', $skill) }}', name: '{{ addslashes($skill->name) }}' })" class="rounded-lg p-2 text-stone-400 transition hover:bg-red-50 hover:text-red-800">
                                    <i data-lucide="trash-2" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-14 text-center">
                            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-stone-100 text-stone-400">
                                <i data-lucide="search" class="h-6 w-6"></i>
                            </div>
                            <p class="mt-3 text-sm font-bold text-stone-700">No skills found</p>
                            <p class="mt-1 text-xs text-stone-400">Adjust your filters or add a new skill.</p>
                            <a href="{{ route('skills.create') }}" class="mt-4 inline-flex items-center gap-1.5 rounded-xl bg-orange-700 px-4 py-2 text-xs font-bold text-amber-50 transition hover:bg-orange-800"><i data-lucide="plus" class="h-3.5 w-3.5"></i>New skill</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if ($skills->hasPages() || $skills->total() > 0)
        <div class="flex flex-col gap-3 border-t border-stone-100 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-xs text-stone-400">Showing <span class="font-bold text-stone-600">{{ $skills->firstItem() ?? 0 }}–{{ $skills->lastItem() ?? 0 }}</span> of <span class="font-bold text-stone-600">{{ $skills->total() }}</span></p>
            <div>{{ $skills->links() }}</div>
        </div>
    @endif
</div>
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Skill::query();

        if ($search = $request->string('search')->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('proficiency_level')) {
            $query->where('proficiency_level', $request->string('proficiency_level')->toString());
        }

        $skills = $query->latest()->paginate(10)->withQueryString();

        return view('skills.index', [
            'skills' => $skills,
            'levels' => Skill::LEVELS,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skills.create', ['levels' => Skill::LEVELS]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skills,name',
            'proficiency_level' => 'required|in:' . implode(',', Skill::LEVELS),
            'description' => 'nullable|string',
        ]);

        Skill::create($validated);

        return redirect()->route('skills.index')->with('success', 'Skill created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skill $skill)
    {
        return view('skills.show', compact('skill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skill $skill)
    {
        return view('skills.edit', ['skill' => $skill, 'levels' => Skill::LEVELS]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skills,name,' . $skill->id,
            'proficiency_level' => 'required|in:' . implode(',', Skill::LEVELS),
            'description' => 'nullable|string',
        ]);

        $skill->update($validated);

        return redirect()->route('skills.index')->with('success', 'Skill updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('skills.index')->with('success', 'Skill deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\LearningResource;
use App\Models\Category;
use Illuminate\Http\Request;

class LearningResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = LearningResource::with('category');

        if ($search = $request->string('search')->toString()) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status')->toString());
        }

        if ($request->filled('type')) {
            $query->where('type', $request->string('type')->toString());
        }

        $resources = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('learning-resources.index', [
            'resources' => $resources,
            'categories' => $categories,
            'types' => LearningResource::TYPES,
            'statuses' => LearningResource::STATUSES,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('learning-resources.create', [
            'categories' => Category::orderBy('name')->get(),
            'types' => LearningResource::TYPES,
            'statuses' => LearningResource::STATUSES,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:' . implode(',', LearningResource::TYPES),
            'url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:' . implode(',', LearningResource::STATUSES),
        ]);

        LearningResource::create($validated);

        return redirect()->route('learning-resources.index')->with('success', 'Learning resource created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(LearningResource $learningResource)
    {
        $learningResource->load(['category', 'learningLogs' => fn ($q) => $q->latest('logged_on')]);

        return view('learning-resources.show', ['resource' => $learningResource]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LearningResource $learningResource)
    {
        return view('learning-resources.edit', [
            'resource' => $learningResource,
            'categories' => Category::orderBy('name')->get(),
            'types' => LearningResource::TYPES,
            'statuses' => LearningResource::STATUSES,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LearningResource $learningResource)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'type' => 'required|in:' . implode(',', LearningResource::TYPES),
            'url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:' . implode(',', LearningResource::STATUSES),
        ]);

        $learningResource->update($validated);

        return redirect()->route('learning-resources.index')->with('success', 'Learning resource updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LearningResource $learningResource)
    {
        $learningResource->delete();

        return redirect()->route('learning-resources.index')->with('success', 'Learning resource deleted successfully.');
    }
}

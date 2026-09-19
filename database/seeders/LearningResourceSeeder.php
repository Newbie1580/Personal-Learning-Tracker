<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\LearningResource;
use Illuminate\Database\Seeder;

class LearningResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $web = Category::where('name', 'Web Development')->first();
        $backend = Category::where('name', 'Backend & Databases')->first();
        $data = Category::where('name', 'Data Science')->first();
        $devops = Category::where('name', 'DevOps & Tools')->first();

        $resources = [
            ['category_id' => $web?->id ?? 1, 'title' => 'Laravel Bootcamp - Build Chirper', 'type' => 'tutorial', 'url' => 'https://bootcamp.laravel.com', 'description' => 'Official hands-on intro to Laravel MVC.', 'status' => 'in_progress'],
            ['category_id' => $backend?->id ?? 1, 'title' => 'Eloquent Relationships Explained', 'type' => 'video', 'url' => 'https://laravel.com/docs/eloquent-relationships', 'description' => 'Master hasMany, belongsTo and eager loading.', 'status' => 'not_started'],
            ['category_id' => $backend?->id ?? 1, 'title' => 'Laravel Routing Deep Dive', 'type' => 'article', 'url' => 'https://laravel.com/docs/routing', 'description' => 'Resource routes, model binding and middleware.', 'status' => 'completed'],
            ['category_id' => $data?->id ?? 1, 'title' => 'Python for Data Analysis', 'type' => 'course', 'url' => 'https://example.com/python-data', 'description' => 'Pandas, NumPy and visualization basics.', 'status' => 'not_started'],
            ['category_id' => $devops?->id ?? 1, 'title' => 'Git Pro Book', 'type' => 'book', 'url' => 'https://git-scm.com/book/en/v2', 'description' => 'Complete reference for Git workflows.', 'status' => 'in_progress'],
        ];

        foreach ($resources as $resource) {
            LearningResource::updateOrCreate(['title' => $resource['title']], $resource);
        }
    }
}

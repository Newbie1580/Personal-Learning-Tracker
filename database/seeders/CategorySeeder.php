<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Web Development', 'description' => 'HTML, CSS, JavaScript and frameworks.', 'color' => '#3B82F6'],
            ['name' => 'Backend & Databases', 'description' => 'PHP, Laravel, SQL and API design.', 'color' => '#10B981'],
            ['name' => 'Data Science', 'description' => 'Python, statistics and machine learning.', 'color' => '#8B5CF6'],
            ['name' => 'DevOps & Tools', 'description' => 'Git, Docker, CI/CD and servers.', 'color' => '#F59E0B'],
            ['name' => 'Soft Skills', 'description' => 'Communication, productivity and career growth.', 'color' => '#EF4444'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}

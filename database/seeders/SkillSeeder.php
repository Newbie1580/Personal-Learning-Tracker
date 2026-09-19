<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['name' => 'Laravel Blade', 'proficiency_level' => 'intermediate', 'description' => 'Build reusable Blade layouts and components.'],
            ['name' => 'Eloquent ORM', 'proficiency_level' => 'beginner', 'description' => 'Define models, relations and query data.'],
            ['name' => 'REST APIs', 'proficiency_level' => 'intermediate', 'description' => 'Design resource controllers and routes.'],
            ['name' => 'Tailwind CSS', 'proficiency_level' => 'beginner', 'description' => 'Style responsive interfaces with utilities.'],
            ['name' => 'Git & GitHub', 'proficiency_level' => 'advanced', 'description' => 'Branch, commit and collaborate effectively.'],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill['name']], $skill);
        }
    }
}

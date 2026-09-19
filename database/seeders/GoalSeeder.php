<?php

namespace Database\Seeders;

use App\Models\Goal;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $goals = [
            ['title' => 'Finish Lab 4 CRUD app', 'description' => 'Complete all migrations, seeders and Blade views.', 'target_date' => now()->addWeek()->toDateString(), 'status' => 'pending'],
            ['title' => 'Master Eloquent relations', 'description' => 'Practice hasMany and belongsTo with seed data.', 'target_date' => now()->addWeeks(2)->toDateString(), 'status' => 'pending'],
            ['title' => 'Learn Tailwind layouts', 'description' => 'Build a responsive nav and dashboard.', 'target_date' => now()->addDays(10)->toDateString(), 'status' => 'pending'],
            ['title' => 'Complete 5 study sessions', 'description' => 'Log at least 5 focused sessions this week.', 'target_date' => now()->addDays(7)->toDateString(), 'status' => 'pending'],
            ['title' => 'Setup SQLite + Vite build', 'description' => 'Verify migrate, seed and npm run build pass.', 'target_date' => now()->toDateString(), 'status' => 'achieved'],
        ];

        foreach ($goals as $goal) {
            Goal::updateOrCreate(['title' => $goal['title']], $goal);
        }
    }
}

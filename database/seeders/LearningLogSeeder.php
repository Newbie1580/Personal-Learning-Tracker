<?php

namespace Database\Seeders;

use App\Models\LearningLog;
use App\Models\LearningResource;
use Illuminate\Database\Seeder;

class LearningLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resource = LearningResource::first();

        if (! $resource) {
            return;
        }

        $logs = [
            ['learning_resource_id' => $resource->id, 'logged_on' => now()->subDays(4)->toDateString(), 'duration_minutes' => 45, 'notes' => 'Reviewed MVC folders and routes.'],
            ['learning_resource_id' => $resource->id, 'logged_on' => now()->subDays(3)->toDateString(), 'duration_minutes' => 60, 'notes' => 'Practiced migrations and models.'],
            ['learning_resource_id' => $resource->id, 'logged_on' => now()->subDays(2)->toDateString(), 'duration_minutes' => 30, 'notes' => 'Seeded categories and skills.'],
            ['learning_resource_id' => $resource->id, 'logged_on' => now()->subDays(1)->toDateString(), 'duration_minutes' => 90, 'notes' => 'Built Blade index and forms.'],
            ['learning_resource_id' => $resource->id, 'logged_on' => now()->toDateString(), 'duration_minutes' => 50, 'notes' => 'Tested CRUD and validation.'],
        ];

        foreach ($logs as $index => $log) {
            LearningLog::updateOrCreate(
                ['learning_resource_id' => $log['learning_resource_id'], 'logged_on' => $log['logged_on']],
                $log
            );
        }
    }
}

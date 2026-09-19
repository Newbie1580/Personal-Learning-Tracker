<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LearningResourceController;
use App\Http\Controllers\SkillController;
use App\Models\Category;
use App\Models\Goal;
use App\Models\LearningLog;
use App\Models\LearningResource;
use App\Models\Skill;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $resourceCount = LearningResource::count();
    $completedCount = LearningResource::where('status', 'completed')->count();

    return view('home', [
        'categoryCount' => Category::count(),
        'resourceCount' => $resourceCount,
        'skillCount' => Skill::count(),
        'goalCount' => Goal::count(),
        'completedCount' => $completedCount,
        'completionRate' => $resourceCount > 0 ? (int) round($completedCount / $resourceCount * 100) : 0,
        'studyMinutes' => (int) LearningLog::sum('duration_minutes'),
        'recentResources' => LearningResource::with('category')->latest()->take(5)->get(),
        'recentLogs' => LearningLog::with('learningResource')->latest('logged_on')->take(5)->get(),
    ]);
})->name('home');

Route::resource('categories', CategoryController::class);
Route::resource('learning-resources', LearningResourceController::class);
Route::resource('skills', SkillController::class);

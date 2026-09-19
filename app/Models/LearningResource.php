<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LearningResource extends Model
{
    use HasFactory;

    public const TYPES = ['article', 'video', 'course', 'book', 'tutorial'];
    public const STATUSES = ['not_started', 'in_progress', 'completed'];

    protected $fillable = [
        'category_id', 'title', 'type', 'url', 'description', 'status',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function learningLogs(): HasMany
    {
        return $this->hasMany(LearningLog::class);
    }
}

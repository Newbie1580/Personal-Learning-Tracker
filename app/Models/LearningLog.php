<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LearningLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'learning_resource_id', 'logged_on', 'duration_minutes', 'notes',
    ];

    protected $casts = [
        'logged_on' => 'date',
    ];

    public function learningResource(): BelongsTo
    {
        return $this->belongsTo(LearningResource::class);
    }
}

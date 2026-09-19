<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    public const STATUSES = ['pending', 'achieved'];

    protected $fillable = ['title', 'description', 'target_date', 'status'];

    protected $casts = [
        'target_date' => 'date',
    ];
}

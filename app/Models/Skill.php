<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    public const LEVELS = ['beginner', 'intermediate', 'advanced'];

    protected $fillable = ['name', 'proficiency_level', 'description'];
}

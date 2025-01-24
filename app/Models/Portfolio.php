<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'intro_heading',
        'intro_detail',
        'cv',
        'skills',
        'experience',
        'education',
        'friends',
    ];

    // Cast JSON fields as arrays
    protected $casts = [
        'skills' => 'array',
        'experience' => 'array',
        'education' => 'array',
        'friends' => 'array',
    ];
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // The attributes that are mass assignable
    protected $fillable = [
        'client_name',
        'project_name',
        'category',
        'description',
        'price',
    ];
}

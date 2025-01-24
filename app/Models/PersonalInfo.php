<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class PersonalInfo extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'intro_heading', 'intro_detail', 'cv', 'image', 
    ];

    protected $hidden = [
        'password',
    ];
}

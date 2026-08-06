<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
        'name',
        'gender',
        'birth_place',
        'birth_date',
        'education',
        'rank',
        'position',
        'photo'
    ];
}
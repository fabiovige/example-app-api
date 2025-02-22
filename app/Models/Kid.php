<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kid extends Model
{
    /** @use HasFactory<\Database\Factories\KidFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'gender',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}

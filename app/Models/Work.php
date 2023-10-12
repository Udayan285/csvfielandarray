<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'key',
        'array_id',
        'booked_at',
        'expired_at',
        'status'
    ];
}

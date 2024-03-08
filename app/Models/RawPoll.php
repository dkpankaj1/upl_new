<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RawPoll extends Model
{
    use HasFactory;
    protected $fillable = [
        'pole_img',
        'latitude',
        'longitude',
        'status',
        'created_by',
        'updated_by',
    ];
}

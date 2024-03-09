<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UtilityPoll extends Model
{
    use HasFactory;
    protected $fillable = [
        'pole',
        'line',
        'latitude',
        'longitude',
        'description',
        'status',
        'route_line_id',
        'created_by',
        'updated_by',
    ];
    
    public function routeLine()
    {
        return $this->belongsTo(RouteLine::class,'route_line_id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class,'updated_by');
    }
}

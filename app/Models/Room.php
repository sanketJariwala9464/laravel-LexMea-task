<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'floor_number',
        'room_number',
        'capacity'
    ]; 

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'room_guest')
                    ->withPivot('assigned_at')
                    ->withTimestamps();
    }
}

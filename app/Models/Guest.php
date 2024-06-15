<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'age',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_guest')
                    ->withPivot('assigned_at')
                    ->withTimestamps();
    }
}

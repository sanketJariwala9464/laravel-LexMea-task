<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RoomGuest extends Pivot
{
    protected $table = 'room_guest';

    protected $fillable = [
        'room_id',
        'guest_id',
        'assigned_at',
    ];
}

?>
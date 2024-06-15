<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomCreateRequest;
use App\Models\{Room, Guest};
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{

    public function get(Request $request) {
        try {
            $rooms = Room::with('guests')->get();

            if ($rooms) {
                return ApiResponse::success($rooms, __('fetch', ['Rooms']));
            }
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function create(RoomCreateRequest $request) {
        try {
            $room = Room::create($request->validated());

            if ($room) {
                return ApiResponse::success($room, __('insert', ['Room']), 201);
            }
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function attachRoom(Request $request, $id) {
        try {
            $room = Room::find($id);

            if (!$room) {
                return ApiResponse::error(__('not_found', ['Room']), 404);
            }

            $guest = null;

            if ($request->guest_id) {
                $guest = Guest::find($request->guest_id);
    
                if (!$guest) {
                    return ApiResponse::error(__('not_found', ['Guest']), 404);
                }
            }

            if ($room->status == config('constants.room_status.READY')) {
                $room->guests()->attach($guest, ['assigned_at' => now()]);
                $room->status = config('constants.room_status.TAKEN');
            } else if ($room->status == config('constants.room_status.TAKEN')) {
                $room->guests()->detach($guest);
                $room->status = config('constants.room_status.MAINTENANCE');
            } else if ($room->status == config('constants.room_status.MAINTENANCE')) {
                $room->status = 'READY';
            }

            $room->save();
            return ApiResponse::success($room, __('attach', ['Room']), 200);
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
}

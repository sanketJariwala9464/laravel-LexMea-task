<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GuestCreateRequest;
use App\Models\Guest;
use App\Helpers\ApiResponse;


class GuestController extends Controller
{
    public function get()
    {
        try {
            $guests = Guest::with('rooms')->get();

            if ($guests) {
                return ApiResponse::success($guests, __('fetch', ['Guests']));
            }
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function create(GuestCreateRequest $request)
    {
        try {
            $guest = Guest::create($request->validated());

            if ($guest) {
                return ApiResponse::success($guest, __('insert', ['Guest']), 201);
            }
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function update(GuestCreateRequest $request, $id)
    {
        try {
            $guest = Guest::find($id);

            if (!$guest) {
                return ApiResponse::error(__('not_found', ['Guest']), 404);
            }

            $guest->update($request->validated());

            return ApiResponse::success($guest, __('update', ['Guest']), 201);
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        try {
            $guest = Guest::find($id);

            if (!$guest) {
                return ApiResponse::error(__('not_found', ['Guest']), 404);
            }

            return ApiResponse::success($guest, __('fetch', ['Guest']));
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $guest = Guest::find($id);

            if (!$guest) {
                return ApiResponse::error(__('not_found', ['Guest']), 404);
            }

            $guest->delete();   

            return ApiResponse::success(null, __('delete', ['Guest']));
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }
}

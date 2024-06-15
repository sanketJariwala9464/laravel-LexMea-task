
<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuestController;

Route::prefix('v1')->group(function() {
    Route::group(['prefix' => 'rooms'], function() {
        Route::get('/', [RoomController::class, 'get']);
        Route::post('/', [RoomController::class, 'create']);
        Route::post('/{id}/assign', [RoomController::class, 'attachRoom']);
    });

    Route::group(['prefix' => 'guests'], function() {
        Route::get('/', [GuestController::class, 'get']);
        Route::post('/', [GuestController::class, 'create']);
        Route::put('/{id}', [GuestController::class, 'update']);
        Route::get('/{id}', [GuestController::class, 'show']);
        Route::delete('/{id}', [GuestController::class, 'destroy']);
    });
})

?>
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Guest capacity per room type (for booking form)
Route::get('/room-type-capacity/{id?}', function ($id = null) {
    $query = \App\Models\Room::where('status', 1);

    if ($id) {
        $query->where('roomtype_id', $id);
    }

    $maxGuests = (int) $query->max(\Illuminate\Support\Facades\DB::raw('CAST(total_adult AS UNSIGNED)'));

    if ($maxGuests < 1) {
        $maxGuests = 1;
    }

    return response()->json(['max_guests' => $maxGuests]);
});

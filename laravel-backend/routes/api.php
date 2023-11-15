<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::get('users', function () {
    $user = User::all();
    return response()->json(['user' => $user], 200);
});

Route::post('users', function (Request $request) {
    $userRequest = $request->all();

    // create coordinates field as type geography with latitude and longitude points
    $userRequest['coordinates'] = \Clickbar\Magellan\Data\Geometries\Point::makeGeodetic($request->latitude, $request->longitude);
    unset($userRequest['latitude']); // remove latitude field
    unset($userRequest['longitude']); // remove longitude field

    // Insert into storage
    $user = User::create($userRequest);

    return response()->json(['user' => $user], 201);
});

<?php

use App\Models\Assignments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/new-assignment', function (Request $request) {
    $assignment = new Assignments();
    $used_exponents = Assignments::pluck('exponent')->toArray();
    $next_exponent = 2; // Starting from the first prime number
    while (in_array($next_exponent, $used_exponents)) {
        $next_exponent = Assignments::nextPrime($next_exponent);
    }
    $assignment->exponent = $next_exponent;
    $assignment->completed = false;
    $assignment->user_id = $request->user()->id;
    $assignment->expiration_date = now()->addWeeks(2);
    $assignment->save();
    return $assignment;
})->middleware('auth:sanctum');

Route::post('/delete-assignment', function (Request $request) {
    $assignment = Assignments::find($request->input('assignment_id'));
    if ($assignment === null) {
        return response()->json(['message' => 'Assignment not found'], 404);
    }
    if ($assignment->user_id !== $request->user()->id) {
        return response()->json(['message' => 'This assignment does not belong to you'], 403);
    }
    if ($assignment->completed) {
        return response()->json(['message' => 'Cannot delete a completed assignment'], 400);
    }
    $assignment->delete();
    return response()->json(['message' => 'Assignment deleted'], 200);
})->middleware('auth:sanctum');

Route::post('/submit-assignment', function (Request $request) {
    $aid = $request->input('assignment_id');
    if (Assignments::find($aid)->completed) {
        return response()->json(['message' => 'Assignment already completed'], 400);
    }
    if (Assignments::where('id', $aid)->where('user_id', $request->user()->id)->doesntExist()) {
        return response()->json(['message' => 'Assignment not found'], 404);
    }
    if (Assignments::where('id', $aid)->where('user_id', $request->user()->id)->where('expiration_date', '<', now())->exists()) {
        Assignments::where('id', $aid)->delete();
        return response()->json(['message' => 'Assignment expired'], 400);
    }
    $assignment = Assignments::find($request->input('assignment_id'));
    $assignment->is_prime = $request->input('is_prime');
    $assignment->completed = true;
    $assignment->save();
    return $assignment;
})->middleware('auth:sanctum');

Route::post('/extend-expiration', function (Request $request) {
    $assignment = Assignments::find($request->input('assignment_id'));
    if ($assignment === null) {
        return response()->json(['message' => 'Assignment not found'], 404);
    }
    if ($assignment->user_id !== $request->user()->id) {
        return response()->json(['message' => 'This assignment does not belong to you'], 403);
    }
    if ($assignment->completed) {
        return response()->json(['message' => 'Cannot extend expiration of a completed assignment'], 400);
    }
    if ($assignment->expiration_date !== null && $assignment->expiration_date < now()) {
        $assignment->delete();
        return response()->json(['message' => 'Cannot extend expiration of an expired assignment'], 400);
    }
    $assignment->expiration_date = now()->addWeeks(2);
    $assignment->save();
    return $assignment;
})->middleware('auth:sanctum');

Route::post('/heartbeat', function (Request $request) {
    // Get exponent of the assignment, if not assigned, send data back
    // having the program drop the assignment and get a new one.
    // GIMPS programs generally do not check regularly if the assignment
    // is still valid for the current use, which sometimes causes problems.
    $assignment = Assignments::where('user_id', $request->user()->id)->where('completed', false)->first();
    if ($assignment === null) {
        return response()->json(['message' => 'No assignment found'], 404);
    } elseif ($assignment->expiration_date !== null && $assignment->expiration_date < now()) {
        $assignment->delete();
        return response()->json(['message' => 'Assignment expired'], 400);
    }
    return response()->json(['message' => 'Success'], 200);
})->middleware('auth:sanctum');

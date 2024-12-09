<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Assignments;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/new-assignment', function (Request $request) {
    $assignment = new Assignments();
    $max_exponent = Assignments::max('exponent');
    $next_prime = Assignments::nextPrime($max_exponent);
    $assignment->exponent = $next_prime;
    $assignment->completed = false;
    $assignment->user_id = $request->user()->id;
    $assignment->save();
    return $assignment;
})->middleware('auth:sanctum');

Route::post('/submit-assignment', function (Request $request) {
    // First, check if the assignment has already been completed
    if (Assignments::find($request->input('assignment_id'))->completed) {
        return response()->json(['message' => 'Assignment already completed'], 400);
    }
    // Second, check if it is assigned to the user
    if (Assignments::where('id', $request->input('assignment_id'))->where('user_id', $request->user()->id)->doesntExist()) {
        return response()->json(['message' => 'Assignment not found'], 404);
    }
    $assignment = Assignments::find($request->input('assignment_id'));
    $assignment->is_prime = $request->input('is_prime');
    $assignment->completed = true;
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
    }
    return response()->json(['message' => 'Success'], 200);
})->middleware('auth:sanctum');
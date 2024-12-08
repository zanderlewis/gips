<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/new-assignment', function (Request $request) {
    $assignment = new \App\Models\Assignments();
    // Smallest prime exponent from the database
    $assignment->exponent = \App\Models\Primes::orderBy('value', 'asc')->first()->value;
    // Check if this assignment already has a user
    while (\App\Models\Assignments::where('exponent', $assignment->exponent)->where('user_id', $request->user()->id)->exists()) {
        // If it does, get the next prime
        $assignment->exponent = \App\Models\Primes::where('value', '>', $assignment->exponent)->orderBy('value', 'asc')->first()->value;
    }
    $assignment->completed = false;
    $assignment->user_id = $request->user()->id;
    $assignment->save();
    return $assignment;
})->middleware('auth:sanctum');

Route::post('/submit-assignment', function (Request $request) {
    // First, check if the assignment has already been completed
    if (\App\Models\Assignments::find($request->input('assignment_id'))->completed) {
        return response()->json(['message' => 'Assignment already completed'], 400);
    }
    // Second, check if it is assigned to the user
    if (\App\Models\Assignments::where('id', $request->input('assignment_id'))->where('user_id', $request->user()->id)->doesntExist()) {
        return response()->json(['message' => 'Assignment not found'], 404);
    }
    $assignment = \App\Models\Assignments::find($request->input('assignment_id'));
    $assignment->completed = true;
    $assignment->save();
    // Delete exponent from primes table
    $prime = \App\Models\Primes::where('value', $assignment->exponent)->first();
    $prime->delete();
    return $assignment;
})->middleware('auth:sanctum');

<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AssignmentsPage;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/assignments', AssignmentsPage::class)->name('assignments');
});

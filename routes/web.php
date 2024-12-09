<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\AssignmentsPage;
use App\Livewire\ResultsPage;
use App\Livewire\Dashboard;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/assignments', AssignmentsPage::class)->name('assignments');
    Route::get('/results', ResultsPage::class)->name('results');
});

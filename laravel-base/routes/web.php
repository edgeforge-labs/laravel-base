<?php
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;

// Route for the landing page, accessible without authentication
Route::get('/', function () {
    return view('landing'); // Ensure you have a 'landing.blade.php' view file
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

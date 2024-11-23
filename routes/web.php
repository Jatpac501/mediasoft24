<?php

use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('checklists', ChecklistController::class)->middleware(['auth', 'verified']);

Route::post('/checklists/{checklist}/items', [ChecklistItemController::class, 'store'])->middleware(['auth', 'verified'])->name('checklists.items.store');
Route::patch('/checklists/{checklist}/items/{item}', [ChecklistItemController::class, 'update'])->name('checklists.items.update');

require __DIR__.'/auth.php';

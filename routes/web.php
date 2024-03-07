<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToDoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $toDos = auth()->user()->todos()->orderBy('status', 'desc')->latest()->get();
    return view('dashboard', compact('toDos'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function() {
    Route::resource('todos', ToDoController::class);
    Route::put('/todos/{todo}/complete', [ToDoController::class, 'complete'])->name('todos.complete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

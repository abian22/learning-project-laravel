<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/list', function () {
    return view('list');
})->middleware(['auth', 'verified'])->name('list');

Route::post('/save', [MovieController::class, 'saveMovies'])->name('save');




Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/movies', [MovieController::class, 'movies'])->middleware(['auth', 'verified'])->name('movies');
    Route::get('/list', [MovieController::class, 'savedMovies'])->middleware(['auth', 'verified'])->name('list');
    Route::post('/movies/save', [MovieController::class, 'guardarPelicula'])->middleware(['auth', 'verified'])->name('movies.save');
    Route::delete('/list', [MovieController::class, 'removeFilm'])->middleware(['auth', 'verified'])->name('list.delete');

    // Route::get('/note', [NoteController::class, 'index'])->name('note.index');
    // Route::get('/note/create', [NoteController::class, 'create'])->name('note.create');
    // Route::post('/note', [NoteController::class, 'store'])->name('note.store');
    // Route::get('/note/{id}', [NoteController::class, 'show'])->name('note.show');
    // Route::get('/note/{id}/edit', [NoteController::class, 'edit'])->name('note.edit');
    // Route::put('/note/{id}', [NoteController::class, 'update'])->name('note.update');
    // Route::delete('/note/{id}', [NoteController::class, 'destroy'])->name('note.destroy');

    Route::resource('index', MovieController::class);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

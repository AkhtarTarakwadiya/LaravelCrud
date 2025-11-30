<?php

use App\Http\Controllers\ArticalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('articals.index');
});

// Route::get('/articals', [ArticalController::class, 'index'])->name('articals.index');
// Route::get('/articals/create', [ArticalController::class, 'create'])->name('articals.create');
// Route::post('/articals', [ArticalController::class, 'store'])->name('articals.store');
// Route::get('/articals/{artical}', [ArticalController::class, 'show'])->name('articals.show');
// Route::get('/articals/{artical}/    edit', [ArticalController::class, 'edit'])->name('articals.edit');
// Route::put('/articals/{artical}', [ArticalController::class, 'update'])->name('articals.update');
// Route::delete('/articals/{artical}', [ArticalController::class, 'destroy'])->name('articals.destroy');

Route::resource('articals', ArticalController::class);

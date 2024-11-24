<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SparepartController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/*---------------Admin---------------- */
Route::get('/admin/login', [AdminController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.loginSubmit');

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/admin-control', [AdminController::class, 'showAdmin'])->name('admin.show');
    Route::get('/admin/create', [AdminController::class, 'addAdmin'])->name('admin.create');
    Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.createSubmit');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/edit', [AdminController::class, 'update'])->name('admin.update');
    Route::post('/admin/{id}', [AdminController::class, 'delete'])->name('admin.delete');

    /*-------------Sparepart-------------- */
    Route::get('/admin/sparepart', [SparepartController::class, 'index'])->name('admin.sparepartShow');

    /*-----------End sparepart-------------- */
});
/*-------------Userr Control-------------- */
/*-------------End Userr-------------- */



/*-------------End Admin-------------- */



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

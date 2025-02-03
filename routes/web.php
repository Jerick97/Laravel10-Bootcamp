<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar rutas web para tu aplicación. Estas
| rutas son cargadas por RouteServiceProvider y todas ellas
| serán asignadas al grupo de middleware "web". ¡Haz algo genial!
|
*/

/* Route::get('/', function () {
    return view('welcome');
}); */

// Ruta abreviada en caso de devolver solo la vista
Route::view('/', 'welcome')->name('welcome');



// comando para ver las rutas de nuestra app
// php artisan route:list --except-vendor

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/chirps', [ChirpController::class, 'index'])->name('chirps.index');
    Route::post('/chirps', [ChirpController::class, 'store'])->name('chirps.store');
    Route::get('/chirps/{chirp}', [ChirpController::class, 'show'])->name('chirps.show');
    /* Route::get('/chirps/{chirp}', function ($chirp) { ///chirps/{chirp?}, function ($chirp = null) para que chirp sea opcional
        //Agregar redireccion
        if($chirp === '2'){
            //forma mas larga return redirect()->route('chirps.index');
            return to_route('chirps.index');
        }
        return 'Chirp ' . $chirp;
    }); */
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__ . '/auth.php';

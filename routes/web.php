<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Chirp;
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
    Route::get('/chirps', function () {
        return view('chirps.index');
    })->name('chirps.index');
    Route::post('/chirps', function () {
        // request();  Retorna un json con los datos del formulario 
        // Insertar en la base de datos
        $validated = request()->validate([
            'message' => 'required|string|max:255',
        ]);
    
        Chirp::create([
            'message' => $validated['message'],
            'user_id' => auth()->id(),
        ]);

        //session()->flash('status','¡El tweet ha sido creado correctamente!');

        return to_route('chirps.index')->with('status',__('The tweet has been created successfully!'));
    });
    Route::get('/chirps/{chirp}', function ($chirp) { ///chirps/{chirp?}, function ($chirp = null) para que chirp sea opcional
        //Agregar redireccion
        if($chirp === '2'){
            //forma mas larga return redirect()->route('chirps.index');
            return to_route('chirps.index');
        }
        return 'Chirp ' . $chirp;
    });
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';

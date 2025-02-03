<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chirps.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // request();  Retorna un json con los datos del formulario 
        // Insertar en la base de datos
        // Validar datos
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Insertar en la base de datos
        Chirp::create([
            'message' => $validated['message'],
            'user_id' => auth()->id(),
        ]);
        //session()->flash('status','¡El tweet ha sido creado correctamente!');
        // Redirigir con mensaje flash
        return to_route('chirps.index')->with('status', __('The tweet has been created successfully!'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        // Agregar redirección si el ID del chirp es '2'
        if ($chirp->id === 2) {
            return to_route('chirps.index');
        }

        return "Chirp ID: " . $chirp->id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}

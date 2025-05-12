<?php

namespace App\Http\Controllers;

use App\Models\Palabra;
use Illuminate\Http\Request;

class PalabraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las palabras con sus definiciones
        $palabras = Palabra::with('definiciones')->get();

        // Devolver las palabras en formato JSON
        return response()->json($palabras);
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
        // Lógica para almacenar una palabra (p.ej. validaciones)
    }

    /**
     * Display the specified resource.
     */
    public function show(Palabra $palabra)
    {
        // Mostrar una palabra específica con sus definiciones
        return response()->json($palabra->load('definiciones'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Palabra $palabra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Palabra $palabra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Palabra $palabra)
    {
        //
    }
}

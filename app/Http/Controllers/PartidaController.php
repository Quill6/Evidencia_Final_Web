<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;
use App\Models\Palabra;
use App\Models\Definicion;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;
use Illuminate\Validation\Rule;

class PartidaController extends Controller
{
    public function iniciar(Request $request) {
        $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'dificultad' => 'sometimes|in:facil,medio,dificil'
        ]);
    
        $partida = Partida::create([
            'user_id' => auth()->id(),
            'categoria_id' => $request->categoria_id,
            'estado' => 'en_progreso'
        ]);
    
        return response()->json($partida, 201);
    }

    
    
    public function siguientePalabra(Partida $partida)
{
    $palabrasUsadas = $partida->respuestas()->pluck('palabra_id');

    $palabra = $partida->palabras()
        ->whereNotIn('palabras.id', $palabrasUsadas)
        ->inRandomOrder()
        ->firstOrFail();

    $definicionCorrecta = $palabra->definiciones()->where('es_correcta', true)->first();

    $definicionesIncorrectas = Definicion::where('palabra_id', '!=', $palabra->id)
        ->inRandomOrder()
        ->limit(3)
        ->get();

    $opciones = $definicionesIncorrectas->push($definicionCorrecta)->shuffle();

    return response()->json([
        'palabra_id' => $palabra->id,
        'palabra_texto' => $palabra->texto,
        'opciones' => $opciones->map(function ($definicion) {
            return [
                'id' => $definicion->id,
                'texto' => $definicion->texto
            ];
        })
    ]);
}
public function responder(Partida $partida, Request $request)
{
    $validated = $request->validate([
        'palabra_id' => 'required|exists:palabras,id',
        'definicion_id' => 'required|exists:definiciones,id'
    ]);

    // Verificar respuesta
    $esCorrecta = Definicion::where('id', $validated['definicion_id'])
        ->where('palabra_id', $validated['palabra_id'])
        ->where('es_correcta', true)
        ->exists();

    // Registrar respuesta
    $partida->respuestas()->create([
        'palabra_id' => $validated['palabra_id'],
        'definicion_id' => $validated['definicion_id'],
        'es_correcta' => $esCorrecta
    ]);

    // Actualizar puntaje
    $puntajeIncremento = $esCorrecta ? 10 : 0;
    $partida->increment('puntaje', $puntajeIncremento);

    return response()->json([
        'correcto' => $esCorrecta,
        'puntaje_actual' => $partida->puntaje,
        'palabras_restantes' => $partida->total_palabras - $partida->respuestas()->count()
    ]);
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    /**Flujo:

Valida categoría y número de palabras

Crea registro en BD

Retorna ID para usar en siguientes requests */
{
    $validated = $request->validate([
        'categoria_id' => [
            'required',
            Rule::exists('categorias', 'id')
        ],
        'total_palabras' => 'required|integer|min:1|max:20'
    ]);

    $partida = Partida::create([
        'user_id' => auth()->id(),
        'categoria_id' => $validated['categoria_id'],
        'total_palabras' => $validated['total_palabras'],
        'puntaje' => 0,
        'estado' => 'en_progreso'
    ]);

    return response()->json([
        'partida_id' => $partida->id,
        'mensaje' => 'Partida iniciada'
    ], 201);

    $palabras = Palabra::where('categoria_id', $validated['categoria_id'])
    ->inRandomOrder()
    ->take($validated['total_palabras'])
    ->get();

$partida->palabras()->attach($palabras->pluck('id'));
}

    /**
     * Display the specified resource.
     */
    public function show(Partida $partida)

    //Muestra el estado actual de la partida.
{
    return response()->json([
        'id' => $partida->id,
        'puntaje' => $partida->puntaje,
        'estado' => $partida->estado,
        'palabras_resueltas' => $partida->respuestas()->count(),
        'palabras_restantes' => $partida->total_palabras - $partida->respuestas()->count(),
        'respuestas_correctas' => $partida->respuestas()->where('es_correcta', true)->count()
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partida $partida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partida $partida)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partida $partida)
    {
        //
    }
}

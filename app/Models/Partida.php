<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    // 🔐 Permitir asignación masiva de estos campos
    protected $fillable = [
        'user_id',
        'categoria_id',
        'puntaje',      // Incluye aquí todos los campos que vayas a guardar
        'dificultad',   // si lo usas
        // agrega más si es necesario
    ];

    // 🔁 Relaciones

    public function palabras()
{
    return $this->belongsToMany(Palabra::class, 'partida_palabra');
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function respuestas()
    {
        return $this->hasMany(Respuesta::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    protected $fillable = [
        'partida_id',
        'palabra_id',
        'definicion_id',
        'es_correcta' // si usas un campo para saber si fue correcta
    ];

    public function partida() {
        return $this->belongsTo(Partida::class);
    }

    public function palabra() {
        return $this->belongsTo(Palabra::class);
    }

    public function definicion() {
        return $this->belongsTo(Definicion::class);
    }
}
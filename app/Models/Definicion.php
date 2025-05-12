<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Definicion extends Model
{
    // Asegúrate de que la tabla sea 'definiciones' en lugar de la pluralización incorrecta
    protected $table = 'definiciones';

    // Relación con el modelo Palabra
    public function palabra() {
        return $this->belongsTo(Palabra::class);
    }
}
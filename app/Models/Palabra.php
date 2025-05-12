<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Palabra extends Model
{
    protected $fillable = [
        'user_id',  // Agrega el campo 'user_id' aquí
        'categoria_id'  // También puedes agregar otros campos que quieras permitir para asignación masiva
    ];

    public function partidas()
{
    return $this->belongsToMany(Partida::class, 'partida_palabra');
}
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function respuestas() {
        return $this->hasMany(Respuesta::class);
    }
    
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function definiciones(){
        return $this->hasMany(Definicion::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['id', 'nombre', 'descripcion'];
    public $timestamps = false;
}

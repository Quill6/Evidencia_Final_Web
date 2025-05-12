<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Palabra;
use App\Models\Definicion;

class CategoriasSeeder extends Seeder
{
    public function run()
    {
        // 1. Limpieza de datos existentes
        Definicion::truncate();
        Palabra::truncate();
        Categoria::truncate();

        // 2. Creación de categorías con IDs fijos
        $categorias = [
            ['id' => 1, 'nombre' => 'Tecnología', 'descripcion' => 'Términos de informática y avances tecnológicos'],
            ['id' => 2, 'nombre' => 'Ciencia', 'descripcion' => 'Conceptos de física, química y biología'],
            ['id' => 3, 'nombre' => 'Arte', 'descripcion' => 'Movimientos artísticos, técnicas y terminología'],
            ['id' => 4, 'nombre' => 'Geografía', 'descripcion' => 'Países, capitales y accidentes geográficos'],
            ['id' => 5, 'nombre' => 'Historia', 'descripcion' => 'Eventos históricos y personajes relevantes'],
            ['id' => 6, 'nombre' => 'Deportes', 'descripcion' => 'Disciplinas deportivas y reglas'],
            ['id' => 7, 'nombre' => 'Literatura', 'descripcion' => 'Obras famosas, autores y géneros literarios'],
            ['id' => 8, 'nombre' => 'Cine', 'descripcion' => 'Películas, directores y términos cinematográficos'],
            ['id' => 9, 'nombre' => 'Música', 'descripcion' => 'Géneros, instrumentos y teoría musical'],
            ['id' => 10, 'nombre' => 'Gastronomía', 'descripcion' => 'Platos típicos, ingredientes y técnicas culinarias'],
            ['id' => 11, 'nombre' => 'Mitología', 'descripcion' => 'Dioses, mitos y leyendas antiguas'],
            ['id' => 12, 'nombre' => 'Economía', 'descripcion' => 'Términos financieros y conceptos económicos'],
            ['id' => 13, 'nombre' => 'Medicina', 'descripcion' => 'Enfermedades, anatomía y procedimientos médicos'],
            ['id' => 14, 'nombre' => 'Videojuegos', 'descripcion' => 'Títulos famosos, plataformas y terminología gamer'],
            ['id' => 15, 'nombre' => 'Redes Sociales', 'descripcion' => 'Plataformas y términos digitales modernos']
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }

        // Reactivar las claves foráneas
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
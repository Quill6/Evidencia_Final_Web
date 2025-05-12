<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Desactivar revisión de claves foráneas para evitar errores
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Limpiar tablas antes de sembrar (solo en desarrollo)
        $this->truncateTables([
            'categorias',
            'palabras',
            'definiciones',
        ]);

        // Ejecutar los seeders
        $this->call([
            CategoriasSeeder::class,
            PalabrasDefinicionesSeeder::class,
        ]);

        // Reactivar las claves foráneas
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Mensaje de confirmación
        $this->command->info('¡Base de datos sembrada exitosamente!');
    }

    // Método para truncar tablas
    protected function truncateTables(array $tables): void
    {
        foreach ($tables as $table) {
            \DB::table($table)->truncate();
        }
    }
}
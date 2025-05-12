<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Palabra;
use App\Models\Definicion;
use App\Models\Categoria;

class PalabrasDefinicionesSeeder extends Seeder
{
    public function run()
    {
        // Desactivar las claves foráneas temporalmente
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Limpieza de datos existentes
        Palabra::truncate();
        Definicion::truncate();

        // Crear palabras con sus definiciones
        $this->crearPalabra(
            1, // id de la categoría
            'Blockchain',
            'Tecnología de registro descentralizado e inmutable',
            ['Lenguaje de programación para apps móviles', 'Dispositivo de almacenamiento en la nube', 'Protocolo de transmisión de video']
        );

        $this->crearPalabra(
            2, // id de la categoría
            'Fotosíntesis',
            'Proceso de conversión de luz solar en energía química',
            ['División celular en organismos', 'Teoría sobre el origen del universo', 'Proceso de digestión en mamíferos']
        );

        $this->crearPalabra(
            3,
            'Impresionismo',
            'Movimiento artístico que enfatiza la luz y el color sobre la precisión del detalle',
            ['Técnica de escultura en mármol', 'Estilo musical barroco', 'Corriente literaria del siglo XXI']
        );
        
        $this->crearPalabra(
            4,
            'Cordillera',
            'Conjunto de montañas alineadas entre sí',
            ['Río subterráneo de gran caudal', 'Depresión en la corteza terrestre', 'Zona de vegetación densa']
        );
        
        $this->crearPalabra(
            5,
            'Revolución Francesa',
            'Movimiento social y político que acabó con la monarquía en Francia en 1789',
            ['Unificación de Alemania en el siglo XIX', 'Expansión del Imperio Romano', 'Tratado de Versalles']
        );
        
        $this->crearPalabra(
            6,
            'Fuera de juego',
            'Situación en la que un jugador está adelantado en el momento del pase y participa en la jugada',
            ['Gol anotado desde medio campo', 'Saque lateral que favorece al rival', 'Tiro penal fallado']
        );
        
        $this->crearPalabra(
            7,
            'Tragedia',
            'Género literario que presenta eventos desafortunados y generalmente un final fatal',
            ['Narración humorística corta', 'Obra que utiliza títeres', 'Poema épico sobre animales']
        );
        
        $this->crearPalabra(
            8,
            'Cineasta',
            'Persona que se dedica a la realización o dirección de películas',
            ['Actor secundario en una obra de teatro', 'Crítico literario profesional', 'Diseñador de efectos especiales en videojuegos']
        );
        
        $this->crearPalabra(
            9,
            'Arpegio',
            'Notas de un acorde tocadas sucesivamente en lugar de simultáneamente',
            ['Silencio absoluto en una partitura', 'Repetición rápida de una nota', 'Corte brusco en la música']
        );
        
        $this->crearPalabra(
            10,
            'Sous-vide',
            'Técnica de cocción en bolsas selladas al vacío a baja temperatura',
            ['Sofrito de verduras', 'Horneado a fuego alto', 'Cocción en olla de presión']
        );
        
        $this->crearPalabra(
            11,
            'Hades',
            'Dios del inframundo en la mitología griega',
            ['Dios del trueno en la mitología nórdica', 'Héroe romano que fundó Roma', 'Gigante que sostenía la Tierra']
        );
        
        $this->crearPalabra(
            12,
            'Inflación',
            'Aumento generalizado y sostenido de los precios de bienes y servicios',
            ['Reducción de impuestos sobre la renta', 'Estancamiento del crecimiento industrial', 'Disminución del valor del dólar frente al euro']
        );
        
        $this->crearPalabra(
            13,
            'Hemoglobina',
            'Proteína en los glóbulos rojos que transporta oxígeno',
            ['Enzima digestiva del estómago', 'Hormona del crecimiento', 'Neurotransmisor cerebral']
        );
        
        $this->crearPalabra(
            14,
            'Respawn',
            'Reaparición de un jugador o enemigo en un videojuego después de ser eliminado',
            ['Pausa para guardar partida', 'Cambio de nivel o fase', 'Intercambio de personajes']
        );
        
        $this->crearPalabra(
            15,
            'Algoritmo',
            'Conjunto de instrucciones ordenadas para resolver un problema',
            ['Base de datos gráfica', 'Tarea automatizada del sistema operativo', 'Estilo visual de una interfaz']
        );

        // Reactivar las claves foráneas
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    // Método para crear palabras y definiciones
    private function crearPalabra($categoriaId, $texto, $definicionCorrecta, $definicionesIncorrectas)
    {
        // Crear palabra
        $palabra = Palabra::create([
            'texto' => $texto,
            'categoria_id' => $categoriaId,
            'dificultad' => $this->asignarDificultad()
        ]);

        // Crear la definición correcta
        Definicion::create([
            'texto' => $definicionCorrecta,
            'es_correcta' => true,
            'palabra_id' => $palabra->id
        ]);

        // Crear las definiciones incorrectas
        foreach ($definicionesIncorrectas as $definicion) {
            Definicion::create([
                'texto' => $definicion,
                'es_correcta' => false,
                'palabra_id' => $palabra->id
            ]);
        }
    }

    // Método para asignar dificultad
    private function asignarDificultad()
    {
        return match (rand(1, 10)) {
            1, 2, 3, 4, 5, 6 => 'facil',
            7, 8, 9 => 'media',
            10 => 'dificil'
        };
    }
}
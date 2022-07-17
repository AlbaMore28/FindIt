<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::create([
            'pregunta' => '¿Cómo puedo registrar un objeto que he encontrado?',
            'respuesta' => 'Te recomendamos que primero eches un vistazo a la lista de objetos buscados para ver si alguien ya está buscando ese objeto perdido.
            Si no se encuentra ahí, puedes registarlo a través del formulario:
            <a class="text-blue-gray-dark" href="#">Registrar Objeto Encontrado</a>'
        ]);
        Faq::create([
            'pregunta' => '¿Cómo puedo registrar un objeto que estoy buscando?',
            'respuesta' => 'Te recomendamos que primero eches un vistazo a la lista de objetos encontrados para ver si alguien lo ha encontrado.
            Si no se encuentra ahí, puedes registar tu objeto a través del formulario:
            <a class="text-blue-gray-dark" href="#">Registrar Objeto Buscado</a>'
        ]);
        Faq::create([
            'pregunta' => '¿Cómo puedo buscar un objeto?',
            'respuesta' => 'Si se trata de un objeto que estás buscando, puedes hacerlo a través de:
            <a class="text-blue-gray-dark" href="#">Lista Objetos Buscados</a>
            Si se trata de un objetoque has encontrado, puedes hacerlo a través de:
            <a class="text-blue-gray-dark" href="#">Lista Objetos Encontrados</a>'
        ]);
        Faq::create([
            'pregunta' => '¿Cómo puedo contactar con la persona que encontró mi objeto?',
            'respuesta' => 'Primero deberás haberte registrado e iniciado sesión a través de:
            <a class="text-blue-gray-dark" href="#">Registrarse/Inicio Sesión</a>
            Después desde la ficha del objeto encontrarás el botón "Contactar"'
        ]);
        Faq::create([
            'pregunta' => '¿Puedo denunciar un mal comportamiento en la web?',
            'respuesta' => 'Sí, podrás hacerlo a través del formulario que encontrarás en:
                <a class="text-blue-gray-dark" href="#">Contacta con Nosotros</a>'
        ]);
    }
}

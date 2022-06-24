<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\ImageObjeto;
use App\Models\Objeto;
use App\Models\ObjetoBuscadoBusca;
use App\Models\ObjetoEncontradoEncuentra;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObjetoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objetos = Objeto::factory(10)->create();
        
        foreach($objetos as $objeto){
            $tipo = rand(0,1);

            switch ($tipo){
                case 0:
                    $objetoBuscadoBusca = ObjetoBuscadoBusca::factory(1)->make()[0];
                    $objetoBuscadoBusca->objeto()->associate($objeto);
                    $objetoBuscadoBusca->save();
                    break;
                case 1:
                    $objetoEncontradoEncuentra = ObjetoEncontradoEncuentra::factory(1)->make()[0];
                    $objetoEncontradoEncuentra->objeto()->associate($objeto);
                    $objetoEncontradoEncuentra->save();
                    break;
            }

            $images = Image::factory(rand(1,3))->url('objetos/')->create();

            foreach($images as $image){
                $imageObjeto = ImageObjeto::factory(1)->make()[0];
                $imageObjeto->image()->associate($image);
                $imageObjeto->objeto()->associate($objeto);
                $imageObjeto->save();
            }
        }
    }
}

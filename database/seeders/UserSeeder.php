<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\ImageUser;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nombre' => 'Alba',
            'apellidos' => 'Moreno',
            'nombre_usuario' => 'alba_more',
            'email' => 'moreno.alba.97@gmail.com',
            'fecha_nac' => '2022-07-28',
            'password' => bcrypt('1234')
        ])->assignRole('Administrador');

        User::create([
            'nombre' => 'Nabil',
            'apellidos' => 'Ali',
            'nombre_usuario' => 'nobol',
            'fecha_nac' => '2022-07-28',
            'email' => 'nobolaa@gmail.com',
            'password' => bcrypt('1234')
        ])->assignRole('Moderador');
        
        $images = Image::factory(10)->url('users/', ['face'])->create(['tipo'=>'user']);
        
        foreach($images as $image){
            $imageUser = ImageUser::factory(1)->make()[0];
            $imageUser->image()->associate($image);
            $imageUser->save();
            
            $user = User::factory(1)->make()[0];
            $user->imageUser()->associate($imageUser);
            $user->save();
        }
    }
}

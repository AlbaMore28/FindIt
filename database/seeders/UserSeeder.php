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

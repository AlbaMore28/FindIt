<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\User;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Storage;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* Storage::deleteDirectory('users');
        Storage::deleteDirectory('objetos');
        Storage::makeDirectory('users');
        Storage::makeDirectory('objetos'); */

        $this->call(RoleSeeder::class);

        /* $this->call(UserSeeder::class);
        $this->call(ObjetoSeeder::class);

        $this->call(FaqSeeder::class); */

    }
}

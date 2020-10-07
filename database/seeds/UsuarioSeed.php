<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Williams',
            'email' => 'wcv.94@hotmail.com',
            'rol' => 'admin',
            'password' => Hash::make('villalvac'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        // $user->perfil()->create();

        $user2 = User::create([
            'name' => 'CEPREVI',
            'email' => 'halva@unfv.edu.pe',
            'rol' => 'admin',
            'password' => Hash::make('123456789'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        // $user2->perfil()->create();
    }
}

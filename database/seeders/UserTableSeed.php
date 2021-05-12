<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'LEANDRO A SILVA',
            'email' => 'leandro@paago.com.br',
            'password' => app('hash')->make('123456')
        ]);
    }
}

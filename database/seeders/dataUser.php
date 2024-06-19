<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Infra\User\Models\User;

class dataUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'name' => 'admin',
            'password' => bcrypt('dragon'),
        ]);
    }
}

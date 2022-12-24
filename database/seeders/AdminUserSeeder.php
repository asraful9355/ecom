<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = AdminUser::create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password')
        ]);
    }
}

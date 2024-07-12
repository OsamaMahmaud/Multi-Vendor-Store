<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminsTableSeeder  extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user=\App\Models\Admin::create([
            "first_name" =>"super",
            "last_name"=> "admin",
            "email"=> "super_admin@gmail.com",
            "password"=> bcrypt("123456"),
            'phone_number'=> "01129945405",
            'username'=>"osos",
        ]);

        $user->addRole("super_admin");
    }
}

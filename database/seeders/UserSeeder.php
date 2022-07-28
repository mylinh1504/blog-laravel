<?php

namespace Database\Seeders;

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
      
        $data =
        [
            [
                'name'=>'admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('123456789'),
                'role_as'=>1,
            ],
            [
                'name'=>'user',
                'email'=>'user@gmail.com',
                'password'=>bcrypt('123456789'),
                'role_as'=>0,
            ],
           
        ];
        foreach($data as $value)
        {
            \App\Models\User::create($value);
        }
    }
 
}

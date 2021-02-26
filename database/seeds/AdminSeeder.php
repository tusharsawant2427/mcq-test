<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new App\Admin([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' =>  bcrypt('12345678'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        $admin->save();
    }
}

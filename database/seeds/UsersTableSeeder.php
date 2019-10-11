<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::Create([
            'name'=>'ahmed',
            'email'=>'ahmed@ahmed',
            'password'=>bcrypt('12345678'),
        ]);
        $user->attachRole('super_admin');
        //
    }
}

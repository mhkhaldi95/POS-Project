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
            'name'=>'Abu Jameel',
            'email'=>'mhkhaldi@gmail.com',
            'password'=>bcrypt('111'),
        ]);
        $user->attachRole('super_admin');
        //
    }
}

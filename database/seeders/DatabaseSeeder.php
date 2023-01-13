<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $user = new User();
        // $user->name = 'Admin';
        // $user->email = 'admin@gmail.com';
        // $user->password = Hash::make('123456');
        // $user->save();

        $user = new Doctor();
        $user->name = 'Doctor Truong';
        $user->doctorname = 'truong.doc';
        $user->email = 'truong.doc@gmail.com';
        $user->password = Hash::make('123456');
        $user->save();


    }
}

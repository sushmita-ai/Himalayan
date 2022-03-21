<?php

namespace Database\Seeders;

use App\Modules\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->delete();

        User::create([
            'first_name' => 'super',
            'barcode' => randomNumber(12),
            'middle_name' => '',
            'last_name' => 'admin',
            'email' => 'superadmin@gmail.com',
            'phone' => '9816810976',
            'username' => 'superadmin',
            'gender' => 'male',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'status' => 'active',
        ]);

        User::create([
            'first_name' => 'Test',
            'barcode' => randomNumber(12),
            'middle_name' => '',
            'last_name' => 'User1',
            'email' => 'testuser1@gmail.com',
            'phone' => '986234234',
            'gender' => 'female',
            'username' => 'testuser1',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'status' => 'active'
        ]);

        User::create([
            'first_name' => 'Test',
            'barcode' => randomNumber(12),
            'middle_name' => '',
            'last_name' => 'User2',
            'email' => 'testuser2@gmail.com',
            'phone' => '98234234234',
            'gender' => 'female',
            'username' => 'testuser2',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'status' => 'active'
        ]);
    }
}

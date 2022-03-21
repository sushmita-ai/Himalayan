<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use App\Modules\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
// use Carbon\Carbon;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        //
        Role::create(['guard_name' => 'admin', 'name' => 'super admin']);
        Role::create(['guard_name' => 'admin', 'name' => 'employee']);

        User::first()->roles()->attach([Role::first()->id]);
        User::skip(1)->first()->roles()->attach([Role::skip(1)->first()->id]);
        User::skip(2)->first()->roles()->attach([Role::skip(1)->first()->id]);
    }
}

<?php

namespace Database\Seeders;

use App\Modules\Models\Attendance;
use App\Modules\Models\User;
use App\Modules\Models\Barcode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('attendances')->delete();

        Attendance::create([
            'start_time' => Carbon::now()->subDays(2),
            'end_time' => Carbon::now()->addHour(6),
            'user_id' => User::skip(1)->first()->id
        ]);

        Attendance::create([
            'start_time' => Carbon::now()->subDays(2),
            'end_time' => Carbon::now()->addHour(6),
            'user_id' => User::skip(2)->first()->id
        ]);

        Attendance::create([
            'start_time' => Carbon::now(),
            'end_time' => null,
            'user_id' => User::skip(1)->first()->id
        ]);

        Attendance::create([
            'start_time' => Carbon::now(),
            'end_time' => null,
            'user_id' => User::skip(1)->first()->id
        ]);
    }
}

<?php

namespace App\Modules\Services\Attendance;

use Carbon\Laravel\ServiceProvider;
use App\Modules\Models\Attendance;
use App\Modules\Models\Barcode;
use App\Modules\Services\Service;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AttendanceService extends Service
{
    protected $attendance;
    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    public function getAllAttendanceData()
    {
        $query = $this->attendance->orderBy('created_at', 'DESC')->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('end_time', function (Attendance $attendance) {
                if ($attendance->end_time) {
                    return $attendance->end_time;
                }
                return '-';
            })
            ->editColumn('status', function (Attendance $attendance) {
                if ($attendance->end_time == null) {
                    return "<div class='badge font-weight-bold badge-light-warning badge-inline'>+ </div>";
                }
                return "<div class='badge font-weight-bold badge-light-success badge-inline'> -</div>";
            })
            ->editColumn('customer_name', function (Attendance $attendance) {
                if ($customer = $attendance->user) {
                    return $customer->first_name . ' ' . $customer->last_name;
                }
                return '-';
            })
            ->rawColumns(['status'])
            ->make(true);
    }

    public function updateAttendance($data)
    {
        return DB::transaction(function () use ($data) {
            $attendance = Attendance::find($data['attendance_id']);

            if ($attendance) {
                if ($attendance->end_time == null) {
                    $attendance->end_time = $data['end_time'];
                    $attendance->update();

                    return $attendance;
                }
            }

            return null;
        });
    }

    public function create($data)
    {
        $data['start_time'] = Carbon::now();
        $attendance = Attendance::create($data);

        if (!$attendance) {
            return null;
        }

        return $attendance;
    }

    // function create(array $data)
    // {
    //     try {
    //         if (!isset($data['password'])) $data['password'] = Hash::make('password');
    //         else $data['password'] =  Hash::make($data['password']);

    //         $createdUser = $this->user->create($data);
    //         if ($createdUser) {
    //             return $createdUser;
    //         } else return NULL;
    //     } catch (Exception $e) {
    //         return null;
    //     }
    //     return null;
    // }

    // public function update($userId, array $data)
    // {
    //     try {

    //         $user = User::findOrFail($userId);
    //         $old_email =  $user->email;

    //         // if(isset($data['location']))
    //         // {
    //         //     $data['location']
    //         // }
    //         // dd($user, $data);
    //         $user->update($data);

    //         if ($old_email != $user->email) {
    //             $user = User::find($userId);
    //             $user->email_verified_at = NULL;
    //             $user->save();
    //             return $user;
    //         }

    //         return $user;
    //     } catch (Exception $e) {
    //         //$this->logger->error($e->getMessage());
    //         return null;
    //     }
    // }

}

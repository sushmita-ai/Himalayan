<?php

namespace App\Modules\Services\User;

use Carbon\Laravel\ServiceProvider;
use App\Modules\Services\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

//models
use App\Modules\Models\User;
use App\Modules\Models\Attendance;

class UserService extends Service
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllData()
    {
        $query = $this->user->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('image', function (User $user) {
                return getTableHtml($user, 'image');
            })
            ->editColumn('roles', function (User $user) {
                return $user->roles()->pluck('name')->implode(', ');
            })
            ->editColumn('status', function (User $user) {
                return getTableHtml($user, 'status');
            })
            ->editColumn('vendor', function (User $user) {
                return $user->vendor->name;
            })
            ->editColumn('actions', function (User $user) {
                $editRoute = route('admin.user.edit', $user->id);
                $deleteRoute = '';
                // $deleteRoute = route('admin.vendor.destroy',$customer->id);
                $optionRoute = '';
                $optionRouteText = '';
                return getTableHtml($user, 'actions', $editRoute, $deleteRoute, $optionRoute, $optionRouteText);
            })->rawColumns(['photo', 'status', 'actions'])
            ->make(true);
    }

    public function getAllEmployeeData()
    {
        $query = $this->user->role('employee')->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('image', function (User $user) {
                return getTableHtml($user, 'image');
            })
            ->editColumn('name', function (User $user) {
                return $user->first_name . ' ' . $user->last_name;
            })
            ->editColumn('status', function (User $user) {
                return getTableHtml($user, 'status');
            })
            ->editColumn('actions', function (User $user) {
                $editRoute = route('admin.employee.edit', $user->id);
                $deleteRoute = '';
                // $deleteRoute = route('admin.vendor.destroy',$employee->id);
                $optionRoute = '';
                $optionRouteText = '';
                return getTableHtml($user, 'actions', $editRoute, $deleteRoute, $optionRoute, $optionRouteText);
            })->rawColumns(['photo', 'status', 'actions'])
            ->make(true);
    }

    function create(array $data)
    {
        try {
            if (!isset($data['password'])) $data['password'] = Hash::make('password');
            else $data['password'] =  Hash::make($data['password']);

            $data['barcode'] =
                $createdUser = $this->user->create($data);
            if ($createdUser) {
                return $createdUser;
            } else return NULL;
        } catch (Exception $e) {
            return null;
        }
        return null;
    }

    public function update($userId, array $data)
    {
        try {

            $user = User::findOrFail($userId);
            $old_email =  $user->email;

            // if(isset($data['location']))
            // {
            //     $data['location']
            // }
            // dd($user, $data);
            $user->update($data);

            if ($old_email != $user->email) {
                $user = User::find($userId);
                $user->email_verified_at = NULL;
                $user->save();
                return $user;
            }

            return $user;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return null;
        }
    }

    public function generateSearchData($code)
    {
        $data = [
            "message" => "",
            "error" => null,
            "view" =>  null,
        ];

        $employee = User::where('barcode', $code)->orWhere('id', (int) $code)->first();

        if ($employee) {
            if ($employee->status == 'in_active') {
                $data['error'] = "Data belongs to inactive user!";
                $data['view'] = view('admin.dashboard.search', ['error' => $data['error']])->render();
                return $data;
            }

            $attendance = Attendance::where('user_id', $employee->id)->where('end_time', null)->get();
            $data['message'] = "Employee data found!";
            $data['view'] =  view('admin.dashboard.search', compact('employee', 'attendance', 'code'))->render();
            return $data;
        }

        $data['error'] = "No data found!";
        $data['view'] = view('admin.dashboard.search', ['error' => $data['error']])->render();
        return $data;
    }

    function uploadFile($file)
    {   // dd('reached',!empty($file), $file);
        if (!empty($file)) { //dd('uploadFile', $file);
            $this->uploadPath = 'uploads/user';
            return $this->uploadFromAjax($file);
        }
    }

    public function updateImage($userId, array $data)
    {
        try {
            $user = $this->user->find($userId);
            $user = $user->update($data);
            // dd($user, $userId, $data);
            return $user;
        } catch (Exception $e) {
            //$this->logger->error($e->getMessage());
            return false;
        }
    }

    public function __deleteImages($user)
    {
        try {
            if (is_file($user->image_path))
                unlink($user->image_path);

            if (is_file($user->thumbnail_path))
                unlink($user->thumbnail_path);
        } catch (Exception $e) {
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Attendance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Requests\Admin\Customer\CustomerRequest;

//services
use App\Modules\Services\Attendance\AttendanceService;
use App\Modules\Services\User\UserService;

//models
use App\Modules\Models\User;
use App\Modules\Models\Barcode;
use App\Modules\Models\Attendance;

class AttendanceController extends Controller
{
    protected $attendance, $user;

    public function __construct(AttendanceService $attendance, Userservice $user)
    {
        $this->attendance = $attendance;
        $this->user = $user;
    }

    public function index()
    {
        return view('admin.attendance.index');
    }

    public function getAllData()
    {
        return $this->attendance->getAllAttendanceData();
    }

    public function updateAttendanceAjax(Request $request)
    {
        if ($request->has('attendance_id')) {
            $attendance_data = $request->all();
            $attendance = $this->attendance->updateAttendance($attendance_data);

            if ($attendance) {
                //fetch return previous data
                $data = $this->user->generateSearchData($request->code);

                if ($data['error'] == null) {
                    $data['message'] = "Attendance payment updated!";
                    return response(compact('data'), 200);
                } else {
                    return response(compact('data'), 400);
                }
            }
        }
        $data['error'] = "Failed to update attendance payment!";
        $data['view'] = view('admin.dashboard.search', ['error' => $data['error']])->render();
        return response(compact('data'), 400);
    }

    public function createAttendanceAjax(Request $request)
    {
        $attendance = $this->attendance->create($request->all());
        if (!$attendance) {
            return response(['message' => "Failed to create Attendance!"], 400);
        }

        if ($request->user_id != null) {
            //fetch return previous data
            $data = $this->user->generateSearchData($request->code);

            if ($data['error'] == null) {
                $data['message'] = "Employee Attendance created!";
                return response(compact('data'), 200);
            } else {
                return response(compact('data'), 400);
            }
        }

        $data['message'] = "Attendance data created!";

        return response(compact('data'), 200);
    }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */

    // public function getAllData()
    // {
    //     return $this->user->getAllCustomerData();
    // }


    // public function index()
    // {
    //     return view('admin.customer.index');
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     // $vendors = Vendor::where('status', 'active')->get();
    //     return view('admin.customer.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(CustomerRequest $request)
    // {
    //     // dd($request->all());
    //     $data = $request->except('image');
    //     $data['status'] = (isset($data['status']) ?  $data['status'] : '') == 'on' ? 'active' : 'in_active';
    //     // dd($data, $request);
    //     return DB::transaction(function () use ($request, $data) {
    //         if ($customer = $this->user->create($data)) {
    //             if ($request->hasFile('image')) {
    //                 $this->uploadFile($request, $customer);
    //             }
    //             //set role here...
    //             $customer->assignRole('customer');
    //             // dd($customer, $request, $data);

    //             Toastr::success('Customer created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
    //             return redirect()->route('admin.customer.index');
    //         }
    //         Toastr::error('Customer cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
    //         return redirect()->route('admin.customer.index');
    //     });
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //TODO: check if user is customer too
    //     $customer = User::find($id);
    //     // dd($customer->location);
    //     // $location = json_decode($customer->location);
    //     // dd($customer, $location);

    //     return view('admin.customer.edit', compact('customer'));
    // }

    // function customerAjax(Request $request)
    // {
    //     // dd($request->all());
    //     $query = User::select('id', 'first_name', 'last_name')
    //         ->when($request->q, function ($query) use ($request) {
    //             $q = $request->q;
    //             $query = $query->where('first_name', 'LIKE', "%" . $q . "%");
    //             $query = $query->orWhere('last_name', 'LIKE', "%" . $q . "%");
    //             return $query;
    //         })->simplePaginate(10);
    //     // dd($query->toArray());
    //     $results = array();
    //     foreach ($query as $object) {
    //         array_push($results, [
    //             'id' => $object['id'],
    //             'text' => $object->first_name . ' ' . $object->last_name
    //         ]);
    //     }

    //     $morePages = true;
    //     $pagination_obj = json_encode($query);
    //     if (empty($query->nextPageUrl())) {
    //         $morePages = false;
    //     }

    //     $pagination = array(
    //         "more" => !is_null($query->toArray()['next_page_url'])
    //     );

    //     // $pagination = [
    //     //     'more' => !is_null($query->toArray()['next_page_url'])
    //     // ];
    //     return compact('results', 'pagination');
    // }
}

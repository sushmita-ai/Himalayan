<?php

namespace App\Http\Controllers\Admin\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Requests\Admin\Employee\EmployeeRequest;

//services
use App\Modules\Services\User\UserService;

//models
use App\Modules\Models\User;
use App\Modules\Models\Barcode;
use App\Modules\Models\Parking;

class EmployeeController extends Controller
{


    protected $user;

    public function __construct(Userservice $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllData()
    {
        return $this->user->getAllEmployeeData();
    }


    public function index()
    {
        return view('admin.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $vendors = Vendor::where('status', 'active')->get();
        return view('admin.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        // dd($request->all());
        $data = $request->except('image');
        $data['status'] = (isset($data['status']) ?  $data['status'] : '') == 'on' ? 'active' : 'in_active';
        $data['barcode'] = randomNumber(12);
        // dd($data, $request);
        return DB::transaction(function () use ($request, $data) {
            if ($employee = $this->user->create($data)) {
                if ($request->hasFile('image')) {
                    $this->uploadFile($request, $employee);
                }
                //set role here...
                $employee->assignRole('employee');
                // dd($employee, $request, $data);

                Toastr::success('Employee created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
                return redirect()->route('admin.employee.index');
            }
            Toastr::error('Employee cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('admin.employee.index');
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //TODO: check if user is employee too
        $employee = User::find($id);
        // dd($employee->location);
        // $location = json_decode($employee->location);
        // dd($employee, $location);

        return view('admin.employee.edit', compact('employee'));
    }

    function employeeAjax(Request $request)
    {
        // dd($request->all());
        $query = User::select('id', 'first_name', 'last_name')
            ->when($request->q, function ($query) use ($request) {
                $q = $request->q;
                $query = $query->where('first_name', 'LIKE', "%" . $q . "%");
                $query = $query->orWhere('last_name', 'LIKE', "%" . $q . "%");
                return $query;
            })->simplePaginate(10);
        // dd($query->toArray());
        $results = array();
        foreach ($query as $object) {
            array_push($results, [
                'id' => $object['id'],
                'text' => $object->first_name . ' ' . $object->last_name
            ]);
        }

        $morePages = true;
        $pagination_obj = json_encode($query);
        if (empty($query->nextPageUrl())) {
            $morePages = false;
        }

        $pagination = array(
            "more" => !is_null($query->toArray()['next_page_url'])
        );

        // $pagination = [
        //     'more' => !is_null($query->toArray()['next_page_url'])
        // ];
        return compact('results', 'pagination');
    }

    function employeeSearch(Request $request)
    {
        if (!empty($request->code)) {
            $data = $this->user->generateSearchData($request->code);

            if ($data['error'] == null) {
                return response(compact('data'), 200);
            } else {
                return response(compact('data'), 400);
            }
        }

        $data['error'] = "Invalid data provided!";
        $data['view'] = view('admin.dashboard.search', ['error' => $data['error']])->render();
        return response(compact('data'), 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        // dd($request->all());
        $data = $request->except('image');
        $data['status'] = (isset($data['status']) ?  $data['status'] : '') == 'on' ? 'active' : 'in_active';

        return DB::transaction(function () use ($request, $data, $id) {
            if ($employee = $this->user->update($id, $data)) {
                if ($request->hasFile('image')) {
                    $this->uploadFile($request, $employee);
                }
                Toastr::success('Employee updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
                return redirect()->route('admin.employee.index');
            }
            Toastr::error('Employee cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('admin.employee.index');
        });
    }

    function uploadFile(Request $request, $employee)
    {
        $file = $request->file('image');
        $fileName = $this->user->uploadFile($file);
        if (!empty($employee->image))
            $this->user->__deleteImages($employee);

        $data['image'] = $fileName;
        $this->user->updateImage($employee->id, $data);
        // dd($fileName, $this->user->updateImage($employee->id, $data), $data);
    }
}

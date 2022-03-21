<?php

namespace App\Http\Controllers\Admin\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use RealRashid\SweetAlert\Facades\Alert;
use App\Modules\Models\Subject;
use App\Http\Requests\Admin\Student\StudentRequest;
use App\Modules\Services\Student\StudentService;
use App\Modules\Services\Subject\SubjectService;



class StudentController extends Controller
{


    protected $student;

    public function __construct(Studentservice $student, SubjectService $subject)
    {
        $this->student = $student;
        $this->subject = $subject;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllData()
    {
        return $this->student->getAllStudentData();
    }


    public function index()
    {
        return view('admin.student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
//         dd($request->all());
        $data = $request->except('image');
        $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';

        return DB::transaction(function () use ($request, $data) {
            if ($student = $this->student->create($data)) {
                if ($request->hasFile('image')) {
                    $this->uploadFile($request, $student);
                }


                Toastr::success('Student created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
                return redirect()->route('admin.student.index');
            }
            Toastr::error('Student cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('admin.student.index');
        });
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = $this->student->find($id);
        return view('admin.student.edit', compact('student'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
//        dd($request->all());
        $data = $request->except('image');
        return DB::transaction(function () use ($request, $data, $id) {

            if ($student = $this->student->update($id, $data)) {

                if ($request->hasFile('image')) {
                    $this->uploadFile($request, $student);
                }


                Toastr::success('Student updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
                return redirect()->route('admin.student.index');
            }
            Toastr::error('Student cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('admin.student.index');
        });

    }


    function uploadFile(Request $request, $student)
    {
        $file = $request->file('image');
        $fileName = $this->student->uploadFile($file);
        if (!empty($student->image))
            $this->student->__deleteImages($student);
        $data['image'] = $fileName;
        $this->student->updateImage($student->id, $data);

    }

    public function destroy($id)
    {
        $this->student->delete($id);
        return redirect()->route('admin.student.index');
    }
}


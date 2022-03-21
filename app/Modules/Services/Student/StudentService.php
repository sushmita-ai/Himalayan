<?php

namespace App\Modules\Services\Student;

use Carbon\Laravel\ServiceProvider;
use App\Modules\Services\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

use App\Modules\Models\Student;

class StudentService extends Service
{
    protected $student;
    public function __construct(Student $student)
    {
        $this->student= $student;
    }


    public function getAllStudentData()
    {$query = $this->student->query();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('image', function (Student $student) {
                return getTableHtml($student, 'image');
            })
            ->editColumn('actions', function (Student $student) {
                $editRoute = route('admin.student.edit', $student->id);
                $deleteRoute = route('admin.student.destroy', $student->id);
                return getTableHtml($student, 'actions', $editRoute, $deleteRoute);
            })->rawColumns(['image', 'status', 'actions'])
            ->make(true);
    }

    function create(array $data)
    {
        try {
            $data['created_by'] = Auth::user()->id;
            $student = $this->student->create($data);
            return $student;

        } catch (Exception $e) {

            return null;
        }
    }

    public function update($studentid, array $data)
    {
    try{
        $student = Student::findOrFail($studentid);

        $student->update($data);


        return $student;
    }
    catch (Exception $e) {

            return null;
}
    }


    function uploadFile($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/student';
            return $this->uploadFromAjax($file);
        }
    }

    public function updateImage($studentId, array $data)
    {
        try {
            $student = $this->student->find($studentId);
            $student = $student->update($data);
            return $student;
        } catch (Exception $e) {
            return false;
        }
    }

    public function __deleteImages($student)
    {
        try {
            if (is_file($student->image_path))
                unlink($student->image_path);

            if (is_file($student->thumbnail_path))
                unlink($student->thumbnail_path);
        } catch (Exception $e) {
        }
    }
    public function find($studentId)
    {
        try {
            return $this->student->find($studentId);
        } catch (Exception $e) {
            return null;
        }
    }
    public function all($id)
    {
        try {
            return $this->student->all($id);
        } catch (Exception $e) {
            return null;
        }
    }


    public function delete($studentid)
    {
        try {

            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $student = $this->student->find($studentid);
            $data['is_deleted']='yes';
            return $student = $student->update($data);

        } catch (Exception $e) {
            return false;
        }
    }

}

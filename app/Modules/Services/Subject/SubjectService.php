<?php

namespace App\Modules\Services\Subject;
use App\Modules\Models\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SubjectService
{
    protected $subject;

    public function __construct(
        Subject $subject
    )
    {
        $this->subject = $subject;
    }

    public function create(array $data)
    {
        try {
            $data['created_by'] = Auth::user()->id;
            $subject = $this->subject->create($data);
            return $subject;

        } catch (Exception $e) {

            return null;
        }
    }


    public function find($subjectId)
    {
        try {
            return $this->subject->find($subjectId);
        } catch (Exception $e) {
            return null;
        }
    }


    public function get()
    {
        try {
            return $this->subject->get();
        } catch (Exception $e) {
            return null;
        }
    }

    public function all($id)
    {
        try {
            return $this->subject->all($id);
        } catch (Exception $e) {
            return null;
        }
    }


    public function update($subjectId, array $data)
    {
        try {

            $data['last_updated_by'] = Auth::user()->id;
            $subject = $this->subject->find($subjectId);

            $subject = $subject->update($data);


            return $subject;
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete($subjectid)
    {
        try {

            $data['deleted_at'] = Carbon::now();
            $subject = $this->subject->find($subjectid);
            return $subject = $subject->update($data);
        } catch (Exception $e) {
            return false;
        }
    }

    public function getData()
    {
        $query = $this->subject->query();
        return Datatables::of($query)
            ->addIndexColumn()
            ->editColumn('actions', function (Subject $subject) {
                $editRoute = route('admin.subject.edit', $subject->id);
                $deleteRoute = route('admin.student.destroy', $subject->id);
                $optionRoute = '';
                $optionRouteText = '';
                return getTableHtml($subject, 'actions', $editRoute, $deleteRoute, $optionRoute, $optionRouteText);
            })
            ->make(true);
    }
//    public function delete($subjectid)
//    {
//        try {
//
//            $data['last_deleted_by']= Auth::user()->id;
//            $data['deleted_at']= Carbon::now();
//            $subject = $this->subject->find($subjectid);
//            $data['is_deleted']='yes';
//            return $subject = $subject->update($data);
//
//        } catch (Exception $e) {
//            return false;
//        }
//    }

    public function getSubjectList()
    {

        $data = [];

        $data = $this->subject::select("id", "name")
            ->when(request()->has('q'), function ($query) {
                $query->where('name', 'LIKE', request('q'));
            })
            ->get();
        return \Response::json($data);
    }

}

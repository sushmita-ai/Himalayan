<?php

namespace App\Http\Controllers\Admin\Subject;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Subject\SubjectRequest;
use App\Modules\Services\Subject\SubjectService;
use Illuminate\Http\Request;

class SubjectController extends Controller
{

    protected $subject;

    function __construct(SubjectService $subject)
    {
        $this->subject = $subject;
    }

    public function index()
    {

        $subject = $this->subject->get();
        return view('admin.subject.index', compact('subject'));
    }

    public function getData()
    {
        $subject = $this->subject->getData();
        return $subject;
    }

    public function create()
    {

        return view('admin.subject.create');
    }


    public function store(SubjectRequest $request)
    {
        $this->subject->create($request->all());
        return redirect('admin/subject')->with('flash_message', 'Subject Added!');

    }


    public function show()
    {
        $subject = $this->subject->get();
        return view('admin.subject.show', compact('subject'));
    }


    public function edit($id)
    {
        $subject = $this->subject->find($id);
        return view('admin.subject.edit', compact('subject'));
    }


    public function update(SubjectRequest $request, $id)
    {
        $subject = $this->subject->find($id);
        $subject->update($request->all());
        return redirect('/admin/subject');

    }
    public function getSubjectList()
    {
        $subject= $this->subject->getSubjectList();
        return $subject;
    }

    public function destroy($id)
    {
        $this->subject->delete($id);
        return redirect()->route('admin.subject.index');

    }
}

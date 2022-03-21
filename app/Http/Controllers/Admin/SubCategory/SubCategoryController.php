<?php

namespace App\Http\Controllers\Admin\SubCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Subcategory\SubcategoryRequest;
use App\Modules\Services\Subcategory\SubcategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;

class SubCategoryController extends Controller
{


    protected $subcategory;

    public function __construct(SubcategoryService $subcategory)
    {
        $this->subcategory = $subcategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllData()
    {
        return $this->subcategory->getAllSubCategoryData();
    }


    public function index()
    {
        return view('admin.subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryRequest $request)
    {
//         dd($request->all());
        $data = $request->except('image');
        $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
        $data['feature'] = (isset($data['feature']) ? $data['feature'] : '') == 'on' ? 'yes' : 'no';
        return DB::transaction(function () use ($request, $data) {
            if ($subcategory = $this->subcategory->create($data)) {
                if ($request->hasFile('image')) {
                    $this->uploadFile($request, $subcategory);
                }


                Toastr::success('Subcategory created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
                return redirect()->route('admin.subcategory.index');
            }
            Toastr::error('Subcategory cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('admin.subcategory.index');
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
        $subcategory = $this->subcategory->find($id);
        return view('admin.subcategory.edit', compact('subcategory'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryRequest $request, $id)
    {
//        dd($request->all());
        $data = $request->except('image');
        $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
        $data['feature'] = (isset($data['feature']) ? $data['feature'] : '') == 'on' ? 'yes' : 'no';
        return DB::transaction(function () use ($request, $data, $id) {

            if ($subcategory = $this->subcategory->update($id, $data)) {

                if ($request->hasFile('image')) {
                    $this->uploadFile($request, $subcategory);
                }


                Toastr::success('subcategory updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
                return redirect()->route('admin.subcategory.index');
            }
            Toastr::error('subcategory cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('admin.subcategory.index');
        });

    }


    function uploadFile(Request $request, $subcategory)
    {
        $file = $request->file('image');
        $fileName = $this->subcategory->uploadFile($file);
        if (!empty($subcategory->image))
            $this->subcategory->__deleteImages($subcategory);
        $data['image'] = $fileName;
        $this->subcategory->updateImage($subcategory->id, $data);

    }

    public function destroy($id)
    {
        $this->subcategory->delete($id);
        return redirect()->route('admin.subcategory.index');
    }
    public function getSubCategoryList()
    {
        $subcategory= $this->subcategory->getSubCategoryList();
        return $subcategory;
    }
}

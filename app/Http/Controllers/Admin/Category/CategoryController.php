<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryRequest;
use App\Modules\Models\Category;
use App\Modules\Services\Category\CategoryService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;

class CategoryController extends Controller
{


    protected $category;

    public function __construct(Categoryservice $category)
    {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllData()
    {
        return $this->category->getAllCategoryData();
    }


    public function index()
    {
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
//         dd($request->all());
        $data = $request->except('image');
        $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
        $data['feature'] = (isset($data['feature']) ? $data['feature'] : '') == 'on' ? 'yes' : 'no';
        return DB::transaction(function () use ($request, $data) {
            if ($category = $this->category->create($data)) {
                if ($request->hasFile('image')) {
                    $this->uploadFile($request, $category);
                }


                Toastr::success('Category created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
                return redirect()->route('admin.category.index');
            }
            Toastr::error('Category cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('admin.category.index');
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
        $category = $this->category->find($id);
        return view('admin.category.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
//        dd($request->all());
        $data = $request->except('image');
        $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'active' : 'in_active';
        $data['feature'] = (isset($data['feature']) ? $data['feature'] : '') == 'on' ? 'yes' : 'no';
        return DB::transaction(function () use ($request, $data, $id) {

            if ($category = $this->category->update($id, $data)) {

                if ($request->hasFile('image')) {
                    $this->uploadFile($request, $category);
                }


                Toastr::success('category updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
                return redirect()->route('admin.category.index');
            }
            Toastr::error('category cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('admin.category.index');
        });

    }


    function uploadFile(Request $request, $category)
    {
        $file = $request->file('image');
        $fileName = $this->category->uploadFile($file);
        if (!empty($category->image))
            $this->category->__deleteImages($category);
        $data['image'] = $fileName;
        $this->category->updateImage($category->id, $data);

    }

    public function destroy($id)
    {
        $this->category->delete($id);
        return redirect()->route('admin.category.index');
    }


    public function getCategoryList()
    {
        $category= $this->category->getCategoryList();
        return $category;
    }
}

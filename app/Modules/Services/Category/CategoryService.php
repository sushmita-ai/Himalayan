<?php

namespace App\Modules\Services\Category;

use App\Modules\Models\Category;
use App\Modules\Services\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;



class CategoryService extends Service
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category= $category;
    }


    public function getAllCategoryData()
    {$query = $this->category->query();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('image', function (Category $category) {
                return getTableHtml($category, 'image');
            })
            ->editColumn('status', function (Category $category) {
                return getTableHtml($category, 'status');
            })
            ->editColumn('feature', function (Category $category) {
                return getTableHtml($category, 'feature');
            })
            ->editColumn('actions', function (Category $category) {
                $editRoute = route('admin.category.edit', $category->id);
                $deleteRoute = route('admin.category.destroy', $category->id);
                return getTableHtml($category, 'actions', $editRoute, $deleteRoute);
            })->rawColumns(['image', 'status','feature', 'actions'])
            ->make(true);
    }

    function create(array $data)
    {
        try {
            $data['created_by'] = Auth::user()->id;
            $category = $this->category->create($data);
            return $category;

        } catch (Exception $e) {

            return null;
        }
    }

    public function update($categoryid, array $data)
    {
        try{
            $category = Category::findOrFail($categoryid);

            $category->update($data);


            return $category;
        }
        catch (Exception $e) {

            return null;
        }
    }


    function uploadFile($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/category';
            return $this->uploadFromAjax($file);
        }
    }

    public function updateImage($categoryId, array $data)
    {
        try {
            $category = $this->category->find($categoryId);
            $category = $category->update($data);
            return $category;
        } catch (Exception $e) {
            return false;
        }
    }

    public function __deleteImages($category)
    {
        try {
            if (is_file($category->image_path))
                unlink($category->image_path);

            if (is_file($category->thumbnail_path))
                unlink($category->thumbnail_path);
        } catch (Exception $e) {
        }
    }
    public function find($categoryId)
    {
        try {
            return $this->category->find($categoryId);
        } catch (Exception $e) {
            return null;
        }
    }
    public function all($id)
    {
        try {
            return $this->category->all($id);
        } catch (Exception $e) {
            return null;
        }
    }


    public function delete($categoryid)
    {
        try {

            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $category = $this->category->find($categoryid);
            $data['is_deleted']='yes';
            return $category = $category->update($data);

        } catch (Exception $e) {
            return false;
        }
    }
    public function getCategoryList()
    {

        $data = [];

        $data = $this->category::select("id", "title")
            ->when(request()->has('q'), function ($query) {
                $query->where('title', 'LIKE', request('q'));
            })
            ->get();
        return \Response::json($data);
    }


}

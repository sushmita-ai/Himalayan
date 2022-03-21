<?php

namespace App\Modules\Services\Subcategory;

use App\Modules\Models\Subcategory;
use App\Modules\Services\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;



class SubcategoryService extends Service
{
    protected $subcategory;
    public function __construct(SubCategory $subcategory)
    {
        $this->subcategory= $subcategory;
    }


    public function getAllSubCategoryData()
    {$query = $this->subcategory->query();
        return DataTables::of($query)
            ->addIndexColumn()
            ->editColumn('image', function (SubCategory $subcategory) {
                return getTableHtml($subcategory, 'image');
            })
            ->editColumn('status', function (SubCategory $subcategory) {
                return getTableHtml($subcategory, 'status');
            })
            ->editColumn('feature', function (SubCategory $subcategory) {
                return getTableHtml($subcategory, 'feature');
            })
            ->editColumn('actions', function (SubCategory $subcategory) {
                $editRoute = route('admin.subcategory.edit', $subcategory->id);
                $deleteRoute = route('admin.subcategory.destroy', $subcategory->id);
                return getTableHtml($subcategory, 'actions', $editRoute, $deleteRoute);
            })->rawColumns(['image', 'status','feature', 'actions'])
            ->make(true);
    }

    function create(array $data)
    {
        try {
            $data['created_by'] = Auth::user()->id;
            $subcategory = $this->subcategory->create($data);
            return $subcategory;

        } catch (Exception $e) {

            return null;
        }
    }

    public function update($subcategory, array $data)
    {
        try{
            $subcategory = Subcategory::findOrFail($subcategory);

            $subcategory->update($data);


            return $subcategory;
        }
        catch (Exception $e) {

            return null;
        }
    }


    function uploadFile($file)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/subcategory';
            return $this->uploadFromAjax($file);
        }
    }

    public function updateImage($subcategoryId, array $data)
    {
        try {
            $subcategory = $this->subcategory->find($subcategoryId);
            $subcategory = $subcategory->update($data);
            return $subcategory;
        } catch (Exception $e) {
            return false;
        }
    }

    public function __deleteImages($subcategory)
    {
        try {
            if (is_file($subcategory->image_path))
                unlink($subcategory->image_path);

            if (is_file($subcategory->thumbnail_path))
                unlink($subcategory->thumbnail_path);
        } catch (Exception $e) {
        }
    }
    public function find($subcategoryId)
    {
        try {
            return $this->subcategory->find($subcategoryId);
        } catch (Exception $e) {
            return null;
        }
    }
    public function all($id)
    {
        try {
            return $this->subcategory->all($id);
        } catch (Exception $e) {
            return null;
        }
    }


    public function delete($subcategoryid)
    {
        try {

            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $subcategory = $this->subcategory->find($subcategoryid);
            $data['is_deleted']='yes';
            return $subcategory = $subcategory->update($data);

        } catch (Exception $e) {
            return false;
        }
    }
    public function getSubCategoryList()
    {

        $data = [];

        $data = $this->subcategory::select("id", "title")
            ->when(request()->has('q'), function ($query) {
                $query->where('title', 'LIKE', request('q'));
            })
            ->get();
        return \Response::json($data);
    }
}

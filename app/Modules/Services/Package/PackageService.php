<?php

namespace App\Modules\Services\Package;

use App\Modules\Models\Package;
use App\Modules\Services\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PackageService extends Service
{
    protected $package;
    public function __construct(Package $package)
    {
        $this->package= $package;
    }


    public function getAllPackageData()
    {$query = $this->package->query();
        return DataTables::of($query)
            ->addIndexColumn()
                ->editColumn('image', function (Package $package) {
                return getTableHtml($package, 'image');
            })
            ->editColumn('status', function (Package $package) {
                return getTableHtml($package, 'status');
            })
            ->editColumn('feature', function (Package $package) {
                return getTableHtml($package, 'feature');
            })
            ->editColumn('deal', function (Package $package) {
                return getTableHtml($package, 'deal');
            })
            ->editColumn('is_trending', function (Package $package) {
                return getTableHtml($package, 'is_trending');
            })
            ->editColumn('actions', function (Package $package) {
                $editRoute = route('admin.package.edit', $package->id);
                $deleteRoute = route('admin.package.destroy', $package->id);
                return getTableHtml($package, 'actions', $editRoute, $deleteRoute);
            })->rawColumns(['image', 'status', 'deal','feature','actions'])
            ->make(true);
    }

    function create(array $data)
    {
        try {
            $data['created_by'] = Auth::user()->id;
            $package = $this->package->create($data);
            return $package;

        } catch (Exception $e) {

            return null;
        }
    }

    public function update($package, array $data)
    {
        try{
            $package = Package::findOrFail($package);

            $package->update($data);


            return $package;
        }
        catch (Exception $e) {

            return null;
        }
    }


    function uploadFile($file,$type=null)
    {
        if (!empty($file)) {
            $this->uploadPath = 'uploads/package';
            return $this->uploadFromAjax($file);
        }
    }

    public function updateImage($packageId, array $data)
    {
        try {
            $package = $this->package->find($packageId);
            $package = $package->update($data);
            return $package;
        } catch (Exception $e) {
            return false;
        }
    }

    public function __deleteImages($package)
    {
        try {
            if (is_file($package->image_path))
                unlink($package->image_path);

            if (is_file($package->thumbnail_path))
                unlink($package->thumbnail_path);
        } catch (Exception $e) {
        }
    }
    public function find($packageId)
    {
        try {
            return $this->package->find($packageId);
        } catch (Exception $e) {
            return null;
        }
    }
    public function all($id)
    {
        try {
            return $this->package->all($id);
        } catch (Exception $e) {
            return null;
        }
    }


    public function delete($packageid)
    {
        try {

            $data['last_deleted_by']= Auth::user()->id;
            $data['deleted_at']= Carbon::now();
            $package = $this->package->find($packageid);
            $data['is_deleted']='yes';
            return $package = $package->update($data);

        } catch (Exception $e) {
            return false;
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Package;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Package\PackageRequest;
use App\Modules\Services\Package\PackageService;
use Illuminate\Http\Request;
use App\Modules\Models\Itinerary;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;

class PackageController extends Controller
{
    protected $package;

    public function __construct(PackageService $package,Itinerary $itinerary)
    {
        $this->package = $package;
        $this->itinerary=$itinerary;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAllData()
    {
        return $this->package->getAllPackageData();
    }


    public function index()
    {
        return view('admin.package.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
    {
//         dd($request->all());
        $data = $request->except('image');
        $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'yes' : 'no';
        $data['feature'] = (isset($data['feature']) ? $data['feature'] : '') == 'on' ? 'yes' : 'no';
        $data['is_trending'] = (isset($data['is_trending']) ? $data['is_trending'] : '') == 'on' ? 'yes' : 'no';
        return DB::transaction(function () use ($request, $data) {
            if ($package = $this->package->create($data)) {
                if ($request->hasFile('image')) {
                    $this->uploadFile($request, $package);
                }
                $p = 0;
                if(!is_null($request->itinerary_title[0])){

                    foreach ($request->itinerary_title as $it_title) {
                        $itinerary = new Itinerary();
                        $itinerary->package_id = $package->id;
                        $itinerary->itinerary_title = $it_title;
                        $itinerary->itinerary_description = $request->itinerary_description[$p];
                        $itinerary->day = $request->day[$p];
                        $itinerary->save();
                        $p = $p + 1;
                    }
                }


                Toastr::success('Package created successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
                return redirect()->route('admin.package.index');
            }
            Toastr::error('Package cannot be created.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('admin.package.index');
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
        $package = $this->package->find($id);
        $itineraries = $this->itinerary->where('package_id',$package->id)->get();
        return view('admin.package.edit', compact('package','itineraries'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, $id)
    {
//        dd($request->all());
        $data = $request->except('image');
        $data['status'] = (isset($data['status']) ? $data['status'] : '') == 'on' ? 'yes' : 'no';
        $data['feature'] = (isset($data['feature']) ? $data['feature'] : '') == 'on' ? 'yes' : 'no';
        $data['is_trending'] = (isset($data['is_trending']) ? $data['is_trending'] : '') == 'on' ? 'yes' : 'no';
        return DB::transaction(function () use ($request, $data, $id) {

            if ($package = $this->package->update($id, $data)) {

                if ($request->hasFile('image')) {
                    $this->uploadFile($request, $package);
                }
                $p = 0;
                foreach ($request->itinerary_title as $it_title) {
                    $itinerary = new Itinerary();
                    $itinerary->package_id = $package->id;
                    $itinerary->itinerary_title = $it_title;
                    $itinerary->itinerary_description = $request->itinerary_description[$p];
                    $itinerary->day = $request->day[$p];
                    $itinerary->save();
                    $p = $p + 1;
                }


                Toastr::success('package updated successfully.', 'Success !!!', ["positionClass" => "toast-bottom-right"]);
                return redirect()->route('admin.package.index');
            }
            Toastr::error('package cannot be updated.', 'Oops !!!', ["positionClass" => "toast-bottom-right"]);
            return redirect()->route('admin.package.index');
        });

    }


    function uploadFile(Request $request, $package)
    {
        $file = $request->file('image');
        $fileName = $this->package->uploadFile($file);
        if (!empty($package->image))
            $this->package->__deleteImages($package);
        $data['image'] = $fileName;
        $this->package->updateImage($package->id, $data);

    }

    public function destroy($id)
    {
        $this->package->delete($id);
        return redirect()->route('admin.package.index');
    }
}

<?php

namespace App\Modules\Models;

use App\Modules\Models\Category;

use App\Modules\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;

    protected $path ='uploads/package';


    protected $fillable = ['id', 'title', 'category_id', 'subcategory_id', 'description','sub_description', 'level',
        'meta_title','meta_description','trip_duration', 'max_altitude','feature','is_trending','status','price','offer_price',
        'cost_excludes', 'image','gallery_images','banner_images', 'cost_includes','package_type'];


    protected $appends = [
        'thumbnail_path', 'image_path', 'banner_path',  'image_path1', 'image_path2'
    ];
    function getStatusTextAttribute()
    {
        return ucwords(str_replace('_', '', $this->status));
    }





    function getImagePathAttribute()
    {
        return $this->path . '/' . $this->image;
    }

    function getBannerPathAttribute()
    {
        if ($this->banner_image) {
            return $this->path . '/' . $this->banner_image;
        } else {
            return 'assets/images/reliance/Background.jpg';
        }
    }

    function getImagePath1Attribute(){
        return $this->path.'/'. $this->image1;
    }

    function getImagePath2Attribute(){
        return $this->path.'/'. $this->image2;
    }

    function getThumbnailPathAttribute(){
        return $this->path.'/thumb/'. $this->image;
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }

    public function itinerary(){
        return $this->belongsTo(Itinerary::class);
    }


}


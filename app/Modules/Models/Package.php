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


    protected $fillable = ['id', 'title', 'category_id', 'subcategory_id', 'description','short_description', 'level',
        'meta_title','meta_description','trip_duration', 'max_altitude','feature','is_trending','status','price','offer_price',
        'cost_excludes', 'image','gallery_images','banner_images', 'cost_includes','package_type','deal','location_map','is_offer','top','special_flags','deleted_at'];


    protected $appends = [
        'thumbnail_path', 'image_path', 'banner_path','gallery_path',  'image_path1', 'image_path2'
    ];
    function getStatusTextAttribute()
    {
        return ucwords(str_replace('_', '', $this->status));
    }
    function getFeatureTextAttribute()
    {
        return ucwords(str_replace('_', '', $this->feature));
    }
    function getdealTextAttribute()
    {
        return ucwords(str_replace('_', '', $this->deal));
    }





    function getImagePathAttribute()
    {
        return $this->path . '/' . $this->image;
    }

    function getBannerPathAttribute()
    {

            return $this->path . '/' . $this->banner_images;

    }
    function getGalleryPathAttribute()
    {
        if ($this->gallery_images) {
            return $this->path . '/' . $this->gallery_images;
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
        return $this->hasMany(Itinerary::class);
    }


}


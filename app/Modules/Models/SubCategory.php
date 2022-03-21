<?php

namespace App\Modules\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $path = 'uploads/subcategory';
    protected $fillable=['title','short_description','image','category_id','last_updated_by','created_by','deleted_at','status','feature'];

    protected $appends = ['thumbnail_path', 'image_path'];

    function getImagePathAttribute()
    {
        if ($this->image)
            return $this->path . '/'  . $this->image;
        else
            return 'assets/media/trek/trek.jpg';
    }
    function getThumbnailPathAttribute()
    {
        if ($this->image)
            return $this->path .  '/' . $this->image;
        else
            return 'assets/media/trek/trek.jpg';
    }
    public function category(){
        return $this->hasMany(Category::class);
    }
    function getStatusTextAttribute()
    {
        return ucwords(str_replace('_', '', $this->status));
    }
    function getFeatureTextAttribute()
    {
        return ucwords(str_replace('_', '', $this->feature));
    }
}

<?php

namespace App\Modules\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $path = 'uploads/category';
    protected $fillable=['title','description','image','featured','status','last_updated_by','deleted_at','created_by'];
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
            return 'assets/media/trek\trek.jpg';
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

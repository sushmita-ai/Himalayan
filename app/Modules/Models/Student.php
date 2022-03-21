<?php

namespace App\Modules\Models;
use App\Modules\Models\Subject;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $path = 'uploads/student';
    protected $fillable=['name','roll','image','subject_id','last_updated_by','created_by','deleted_at','status','visibility'];

    protected $appends = ['thumbnail_path', 'image_path'];

    function getImagePathAttribute()
    {
        if ($this->image)
            return $this->path . '/'  . $this->image;
        else
            return 'assets/media/user_placeholder.png';
    }
    function getThumbnailPathAttribute()
    {
        if ($this->image)
            return $this->path .  '/' . $this->image;
        else
            return 'assets/media/user_placeholder.png';
    }
    public function subject(){
     return $this->hasMany(Subject::class);
    }

}

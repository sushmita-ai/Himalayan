<?php

namespace App\Modules\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Itinerary extends Model
{
    use HasFactory;
    use SoftDeletes;
    //
    protected $fillable=['package_id','itinerary_title','day','itinerary_description'];

    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }
}

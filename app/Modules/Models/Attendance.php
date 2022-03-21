<?php

namespace App\Modules\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', 'start_time', 'user_id', 'end_time', 'type'
    ];

    /**
     * Get the parent barcodeable model (Attendance or customer).
     */
    public function barcode()
    {
        return $this->morphOne(Barcode::class, 'barcodeable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

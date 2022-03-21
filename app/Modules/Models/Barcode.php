<?php

namespace App\Modules\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barcode extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', 'code', 'barcodeable_id', 'barcodeable_type'
    ];

    /**
     * Get the parent barcodeable model (parking or customer).
     */
    public function barcodeable()
    {
        return $this->morphTo();
    }
}

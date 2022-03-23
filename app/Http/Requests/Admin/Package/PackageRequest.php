<?php

namespace App\Http\Requests\Admin\Package;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'category_id'=>'required'
        ];
    }
    public function data()
    {
        $data = [
            'title'    => $this->get('title'),
            'category_id'  => $this->get('category_id'),
            'subcategory_id'  => $this->get('subcategory_id'),
            'description'  => $this->get('description'),
            'sub_description'  => $this->get('sub_description'),
            'trip_duration'  => $this->get('trip_duration'),

            'price'  => $this->get('price'),
            'offer_price'  => $this->get('offer_price'),
            'cost_includes'  => $this->get('cost_includes'),

            'cost_excludes'  => $this->get('cost_excludes'),
            'location_map'  => $this->get('location_map'),
            'feature' => ($this->get('is_featured') ? $this->get('is_featured') : '') == 'on' ? '1' : '0',
            'is_trending' => ($this->get('is_trending') ? $this->get('is_trending') : '') == 'on' ? '1' : '0',
            'status' => ($this->get('status') ? $this->get('status') : '') == 'on' ? '1' : '0',
        ];

        return $data;
    }
}

<?php

namespace App\Http\Requests\Admin\Employee;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Support\Facades\Validator;


use Illuminate\Contracts\Validation\Validator;
use \Carbon\Carbon;


class EmployeeRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users,username,' . $this->route('employee'),
            'phone' => 'required|integer|unique:users,phone,' . $this->route('employee'),
        ];
    }
}

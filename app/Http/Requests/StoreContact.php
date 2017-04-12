<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContact extends FormRequest
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
            'name' => 'required|min:3',
//            'email' => 'unique:email',
//            'phone' => 'numeric|min:6|present',
//            'address' => 'min:6',
//            'organization' => 'min:3',
//            'birthday' => 'date',
        ];
    }
}

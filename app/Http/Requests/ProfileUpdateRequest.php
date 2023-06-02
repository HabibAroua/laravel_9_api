<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'phone' => 'sometimes|digits_between:5,20|unique:users,phone,'.$this->user()->id,
            'gender'=> 'sometimes|max:50',
            'email' => 'required|unique:users,email,'.$this->user()->id,
            'birth_date' => 'sometimes|date_format:d-m-Y',
            'image' => ['image', 'mimes:jpg,png,jpeg,webp', 'max:2048'],
        ];
    }
}

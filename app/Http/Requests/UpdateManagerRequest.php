<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateManagerRequest extends FormRequest
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
            'branch_id' => ['required', 'integer'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required','string'],
            'password' => ['required', 'confirmed'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
        ];
    }
}

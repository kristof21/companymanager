<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lastname' => ['required', 'string', 'max:25'],
            'firstname' => ['required', 'string', 'max:25'],
            'company_id' => 'required',
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:16']
        ];
    }
}

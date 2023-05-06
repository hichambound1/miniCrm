<?php

namespace App\Http\Requests\Employe;

use Illuminate\Foundation\Http\FormRequest;

class EditMyAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "email"=>"required|unique:users,email,".auth()->user()->id,
            "name"=>"required|string",
            "password"=>"required|confirmed",
            'birthday'=>'required|date',
            'tel'=>"required|string",
            'address'=>"required|string",
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if(request()->method() == "POST"){
            return [
                "name"=>"required|string",
                "image"=>"file|image|required|mimes:png,jpg"
            ];
        }
        return [
            "name"=>"required|string",
            "image"=>"file|image|nullable|mimes:png,jpg"
        ];
    }
}

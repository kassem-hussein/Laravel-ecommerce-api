<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
               "name"=>"string|required",
               "image"=>"required|file|image|mimes:png,jpg"
           ];
       }else{
           return [
               "name"=>"string|required",
               "image"=>"nullable|file|image|mimes:png,jpg"
           ];
       }
    }
}

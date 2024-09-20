<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            "name"=>"required|string|max:50",
            "description"=>"required|string",
            "price"=>"required|numeric",
            "brand"=>"required|exists:brands,id",
            "category"=>"required|exists:categories,id",
            "note"=>"string|nullable",
            "offer"=>"integer|nullable"
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            "address"=>"required|exists:addresses,id",
            "shipping"=>"nullable|numeric",
            "status"=>"nullable|in:started,ready,in way,done",
            "items"=>"required|array",
            "items.*.product"=>"required|exists:products,id",
            "items.*.quantity"=>"required|integer",
            "items.*.size"=>"nullable|exists:sizes,id",
            "items.*.color"=>"nullable|exists:colors,id"
        ];
    }
}

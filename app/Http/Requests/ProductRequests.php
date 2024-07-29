<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequests extends FormRequest
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
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'sku' => 'required|string|max:255|unique:products,sku',
            'barcode' => 'string|max:255|unique:products,barcode',
            'stock_on_hand' => 'nullable|integer|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'supplier' => 'nullable|string|max:255',
            'buying_price' => 'nullable|numeric|min:0',
            'buying_date' => 'nullable|date',
            'weight' => 'nullable|numeric|min:0',
            'weightUnit' => 'nullable|string|max:10',
            'tags' => 'nullable',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable',
        ];
    }
}

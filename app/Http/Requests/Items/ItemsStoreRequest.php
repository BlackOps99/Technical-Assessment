<?php

namespace App\Http\Requests\Items;

use Illuminate\Foundation\Http\FormRequest;

class ItemsStoreRequest extends FormRequest
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
            'name_en' => 'required|string|unique:partitions',
            'name_ar' => 'required|string|unique:partitions',
            'cat_id' => 'required|numeric|exists:categories,id',
            'partition_id' => 'required|numeric|exists:partitions,id',
        ];
    }
}

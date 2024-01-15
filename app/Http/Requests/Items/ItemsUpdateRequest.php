<?php

namespace App\Http\Requests\Items;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemsUpdateRequest extends FormRequest
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
            'name_en' => 'sometimes|required|string|'.Rule::unique('items', 'name_en')->ignore($this->route('items'), 'id'),
            'name_ar' => 'sometimes|required|string|'.Rule::unique('items', 'name_ar')->ignore($this->route('items'), 'id'),
            'cat_id' => 'sometimes|required|numeric|exists:categories,id',
            'partition_id' => 'sometimes|required|numeric|exists:partitions,id'
        ];
    }
}

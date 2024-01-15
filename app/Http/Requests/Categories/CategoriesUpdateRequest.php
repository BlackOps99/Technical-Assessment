<?php

namespace App\Http\Requests\Categories;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoriesUpdateRequest extends FormRequest
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
            'name_en' => 'sometimes|required|string|'.Rule::unique('categories', 'name_en')->ignore($this->route('category'), 'id'),
            'name_ar' => 'sometimes|required|string|'.Rule::unique('categories', 'name_ar')->ignore($this->route('category'), 'id')
        ];
    }
}

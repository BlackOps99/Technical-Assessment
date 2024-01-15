<?php

namespace App\Http\Requests\Partitions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PartitionsUpdateRequest extends FormRequest
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
            'name_en' => 'sometimes|required|string|'.Rule::unique('partitions', 'name_en')->ignore($this->route('partitions'), 'id'),
            'name_ar' => 'sometimes|required|string|'.Rule::unique('partitions', 'name_ar')->ignore($this->route('partitions'), 'id'),
            'cat_id' => 'sometimes|required|numeric|exists:categories,id'
        ];
    }
}

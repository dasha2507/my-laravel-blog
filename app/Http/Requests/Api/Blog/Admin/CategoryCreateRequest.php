<?php

namespace App\Http\Requests\Api\Blog\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title'     => 'required|string|min:3|max:255',
            'slug'      => 'nullable|string|max:255|unique:blog_categories,slug',
            'parent_id' => 'nullable|integer|exists:blog_categories,id',
        ];
    }
}

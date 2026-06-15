<?php

namespace App\Http\Requests\Api\Blog\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'slug'  => 'nullable|string|max:255|unique:blog_categories,slug,' . $this->route('category'),
        ];
    }
}

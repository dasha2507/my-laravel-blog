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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|min:5|max:200',
            'slug'        => 'nullable|string|max:200',
            'description' => 'string|max:500|min:3',
            'parent_id'   => 'required|integer|exists:blog_categories,id',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required'    => 'Введіть заголовок категорії',
            'title.min'         => 'Мінімальна довжина заголовка — 5 символів',
            'parent_id.exists'  => 'Обрана батьківська категорія не існує',
        ];
    }
}

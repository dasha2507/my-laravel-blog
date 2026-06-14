<?php

namespace App\Http\Controllers\Api\Blog\Admin;

use App\Models\BlogCategory;
use App\Http\Resources\Api\Blog\Admin\CategoryResource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Blog\Admin\CategoryCreateRequest;
use App\Http\Requests\Api\Blog\Admin\CategoryUpdateRequest;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Отримуємо пагіновані дані (по 5 записів на сторінку)
        $paginator = BlogCategory::paginate(5);

        // Обгортаємо пагінацію в API Ресурс
        return CategoryResource::collection($paginator);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {
        $data = $request->all();

        $item = BlogCategory::create($data);

        if ($item) {
            return [
                'success' => true,
                'message' => 'Успішно створено',
                'id' => $item->id
            ];
        } else {
            return ['success' => false, 'message' => 'Помилка створення'];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {
        $item = BlogCategory::find($id);

        if (empty($item)) {
            return ['message' => "Запис id=[{$id}] не знайдено"];
        }

        $data = $request->all();

        $result = $item->update($data);

        if ($result) {
            return ['success' => true, 'message' => 'Успішно збережено'];
        } else {
            return ['message' => 'Помилка збереження'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api\Blog\Admin;

use App\Models\BlogCategory;
use App\Http\Resources\Api\Blog\Admin\CategoryResource;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Blog\Admin\CategoryCreateRequest;
use App\Http\Requests\Api\Blog\Admin\CategoryUpdateRequest;

class CategoryController extends BaseController
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 5);
        $search = $request->input('search');

        $query = BlogCategory::query();

        if (!empty($search)) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $paginator = $query->paginate($perPage);

        return CategoryResource::collection($paginator);
    }

    public function store(CategoryCreateRequest $request)
    {
        $data = $request->all();
        $item = BlogCategory::create($data);

        if ($item) {
            return ['success' => true, 'message' => 'Успішно створено', 'id' => $item->id];
        } else {
            return ['success' => false, 'message' => 'Помилка створення'];
        }
    }

    public function show(string $id)
    {
        $item = BlogCategory::find($id);
        if (empty($item)) return response()->json(['message' => 'Запис не знайдено'], 404);

        return new CategoryResource($item);
    }

    public function update(CategoryUpdateRequest $request, string $id)
    {
        $item = BlogCategory::find($id);
        if (empty($item)) return response()->json(['message' => "Запис id=[{$id}] не знайдено"], 404);

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            return ['success' => true, 'message' => 'Успішно збережено'];
        } else {
            return response()->json(['message' => 'Помилка збереження'], 500);
        }
    }

    public function destroy(string $id)
    {
        $result = BlogCategory::destroy($id);
        if ($result) {
            return ['success' => true, 'message' => "Категорію успішно видалено"];
        }
        return response()->json(['message' => 'Помилка видалення'], 500);
    }
}

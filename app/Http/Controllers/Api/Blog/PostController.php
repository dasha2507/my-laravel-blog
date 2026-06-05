<?php

namespace App\Http\Controllers\Api\Blog;

use App\Models\BlogPost;
use App\Http\Resources\Api\Blog\PostResource;
use App\Http\Resources\Api\Blog\PostCollection;
use App\Http\Requests\Api\Blog\PostCreateRequest;
use App\Http\Requests\Api\Blog\PostUpdateRequest;
use App\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogPostUpdateRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = BlogPost::with(['category', 'user'])->get();

        return new PostCollection($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostCreateRequest $request)
    {
        $data = $request->all();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $data['user_id'] = 1;

        $item = BlogPost::create($data);

        if ($item) {
            return new PostResource($item);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = BlogPost::with(['category', 'user'])->findOrFail($id);

        return new PostResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $item = $this->blogPostRepository->getEdit($id);
        if (empty($item)) { //якщо ід не знайдено
            return ['message' => "Запис id=[{$id}] не знайдено"];
        }

        $data = $request->all(); //отримаємо масив даних, які надійшли з форми

        $result = $item->update($data); //оновлюємо дані об'єкта і зберігаємо в БД

        if ($result) {
            return [
                'success' => true,
                'message' => 'Успішно збережено'
            ];
        } else {
            return ['message' => 'Помилка збереження'];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = BlogPost::findOrFail($id);

        $result = $item->delete();

        if ($result) {
            return ['success' => true];
        }
    }
}

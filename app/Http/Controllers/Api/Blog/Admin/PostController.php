<?php

namespace App\Http\Controllers\Api\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogPostUpdateRequest;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\BlogPost;
use App\Http\Requests\BlogPostCreateRequest;

class PostController extends Controller
{
    private BlogPostRepository $blogPostRepository;
    private BlogCategoryRepository $blogCategoryRepository;

    public function __construct(
        BlogPostRepository $blogPostRepository,
        BlogCategoryRepository $blogCategoryRepository
    ) {
        $this->blogPostRepository = $blogPostRepository;
        $this->blogCategoryRepository = $blogCategoryRepository;
    }

    /**
     * Display a listing of the resource (Отримання списку всіх статей).
     */
    public function index()
    {
        $items = BlogPost::all();

        return response()->json([
            'success' => true,
            'data' => $items
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogPostUpdateRequest $request, $id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) { // якщо id не знайдено
            return ['message' => "Запис id=[{$id}] не знайдено"];
        }

        $data = $request->all(); // отримаємо масив даних, які надійшли з форми

        if (empty($data['slug'])) { // якщо псевдонім порожній
            $data['slug'] = Str::slug($data['title']); // генеруємо псевдонім
        }

        if (empty($item->published_at) && $data['is_published']) { // якщо поле published_at порожнє і нам прийшло 1 в ключі is_published, то
            $data['published_at'] = Carbon::now(); // генеруємо поточну дату
        }

        $result = $item->update($data); // оновлюємо дані об'єкта і зберігаємо в БД

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
    public function destroy($id)
    {
        $result = BlogPost::destroy($id);

        if ($result) {
            return [
                'success' => true,
                'message' => 'Статтю видалено'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Помилка видалення'
            ];
        }
    }
}

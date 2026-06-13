<?php

namespace App\Http\Controllers\Api\Blog;

use App\Models\BlogPost;
use App\Http\Resources\PostResource;
use App\Repositories\BlogPostRepository;
use App\Http\Requests\Api\Blog\PostCreateRequest;
use App\Http\Requests\Api\Blog\PostUpdateRequest;
use App\Http\Requests\BlogPostUpdateRequest;
use App\Jobs\BlogPostAfterCreateJob;
use App\Jobs\BlogPostAfterDeleteJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends BaseController
{
    private BlogPostRepository $blogPostRepository;
    public function __construct(BlogPostRepository $blogPostRepository)
    {
        //parent::__construct();
        $this->blogPostRepository = $blogPostRepository;
    }

    /**
     * Отримання списку статей (для таблиці Nuxt)
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10);
        $search = $request->input('search', null);
        $sortBy = $request->input('sortBy', 'id');
        $sortDir = $request->input('sortDir', 'desc');

        $items = $this->blogPostRepository->getAllWithPaginate($perPage, $search, $sortBy, $sortDir);

        return PostResource::collection($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->input();

        $item = (new BlogPost())->create($data);

        if ($item) {
            BlogPostAfterCreateJob::dispatch($item);
            return ['success' => true, 'message' => 'Успішно збережено'];
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

        if (empty($item)) {
            return ['message' => "Запис id=[{$id}] не знайдено"];
        }

        $data = $request->all();
        $result = $item->update($data);

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
            BlogPostAfterDeleteJob::dispatch($id)->delay(20);
            return ['success' => true, 'message' => "Запис [{$id}] успішно видалено"];
        }
    }
}

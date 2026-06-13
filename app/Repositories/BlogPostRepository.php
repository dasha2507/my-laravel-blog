<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;

class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Отримуємо статті з пагінацією, пошуком та сортуванням.
     * Приймаємо параметри з контролера (з фронтенду).
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate(int $perPage = 25, ?string $search = null, ?string $sortBy = 'id', ?string $sortDir = 'desc')
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $query = $this->startConditions()
            ->select($columns)
            ->with([
                'category' => function ($query) {
                    $query->select(['id', 'title']);
                },
                'user:id,name',
            ]);

        $query->search('title', $search)->sort($sortBy, $sortDir);

        return $query->paginate($perPage);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

}

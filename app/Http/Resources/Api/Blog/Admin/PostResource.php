<?php

namespace App\Http\Resources\Api\Blog\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Трансформація ресурсу в масив.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'is_published'   => (bool) $this->is_published,

            'published_at'   => $this->published_at ? \Carbon\Carbon::parse($this->published_at)->format('Y-m-d H:i:s') : null,

            'excerpt'        => $this->excerpt,
            'content_raw'    => $this->content_raw,
            'user_id'        => $this->user_id,
            'category_id'    => $this->category_id,

            'user'           => [
                'name' => $this->user ? $this->user->name : 'Невідомо',
            ],
            'category'       => [
                'title' => $this->category ? $this->category->title : 'Без категорії',
            ],
        ];
    }
}

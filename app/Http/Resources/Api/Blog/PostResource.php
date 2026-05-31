<?php

namespace App\Http\Resources\Api\Blog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'excerpt' => $this->excerpt,
            'content_raw' => $this->content_raw,
            'content_html' => $this->content_html,
            'is_published' => $this->is_published,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => [
                'id' => $this->user_id,
                'name' => $this->user ? $this->user->name : null,
            ],
            'category' => [
                'id' => $this->category_id,
                'title' => $this->category ? $this->category->title : null,
            ],
        ];
    }
}

<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FilterableTrait
{
    /**
     * Логіка пошуку.
     * За вимогою викладача шукаємо по початку слова (LIKE 'текст%')
     */
    public function scopeSearch(Builder $query, ?string $searchField, ?string $searchQuery): Builder
    {
        if (!empty($searchField) && !empty($searchQuery)) {
            return $query->where($searchField, 'LIKE', $searchQuery . '%');
        }

        return $query;
    }

    /**
     * Логіка сортування по колонкам
     */
    public function scopeSort(Builder $query, ?string $sortBy, ?string $sortDirection = 'asc'): Builder
    {
        if (!empty($sortBy)) {
            // Перевіряємо напрямок, щоб уникнути помилок SQL
            $direction = strtolower($sortDirection) === 'desc' ? 'desc' : 'asc';
            return $query->orderBy($sortBy, $direction);
        }

        return $query;
    }
}

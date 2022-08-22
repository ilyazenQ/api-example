<?php

namespace App\Elastic\Traits;


use App\Elastic\Observers\ElasticsearchPostsObserver;

trait  Searchable
{
    public static function bootSearchable(): void
    {
        static::observe(ElasticsearchPostsObserver::class);
    }

    public function getSearchIndex(): string
    {
        return $this->getTable();
    }

    public function getSearchType(): string
    {
        return "_doc";
    }

    public function toSearchArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
        ];
    }
}

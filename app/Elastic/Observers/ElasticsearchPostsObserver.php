<?php

namespace App\Elastic\Observers;

use Elasticsearch\Client;

class ElasticsearchPostsObserver
{
    public function __construct(
        private Client $elasticsearch
    ) {
    }

    public function saved($model): void
    {
        $this->elasticsearch->index([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
            'body' => $model->toSearchArray(),
        ]);
    }

    public function deleted($model): void
    {
        $this->elasticsearch->delete([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'id' => $model->getKey(),
        ]);
    }
}


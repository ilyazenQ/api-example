<?php

namespace App\Elastic;

namespace App\Elastic;

use App\Models\Post;
use Elasticsearch\Client;
use Illuminate\Support\Arr;

class ElasticSearchPosts
{
    public function __construct(
        private Client $elasticsearch,
        private Post $post
    ) {
    }

    public function search(string $queryString = ''): array
    {
        return $this->buildCollection(
            $this->searchOnElastic($queryString)
        );
    }

    private function searchOnElastic(string $queryString): array
    {
        return $this->elasticsearch->search([
            'index' => $this->post->getSearchIndex(),
            'type' => $this->post->getSearchType(),
            'body' => [
                'size' => 10,
                'query' => [
                    'multi_match' => [
                        'fields' => ['body^2', 'title'],
                        'query' => $queryString,
                    ],
                ],
            ],
        ]);
    }

    private function buildCollection(callable|array $item): array
    {
        return Arr::pluck($item['hits']['hits'], '_source');
    }
}


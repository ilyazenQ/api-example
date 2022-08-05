<?php

namespace App\Actions;

use App\Elastic\ElasticSearchPosts;

class FindByElasticAction
{
    public function execute(array $fields, ElasticSearchPosts $elasticSearch): array
    {
        $queryString = (new GetQueryStringFromReqAction())->execute($fields);

        return $elasticSearch->search($queryString);
    }

}

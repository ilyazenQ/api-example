<?php
namespace App\Queries;

use App\Models\Post;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PostQuery extends QueryBuilder
{
    public function __construct()
    {
        $query = Post::query();

        parent::__construct($query);

        $this->allowedSorts(['id', 'user_id']);

        $this->allowedFilters([
            AllowedFilter::exact('id'),
            AllowedFilter::exact('user_id'),
            AllowedFilter::exact('slug'),
            AllowedFilter::exact('title'),
        ]);

        $this->defaultSort('id');
    }
}

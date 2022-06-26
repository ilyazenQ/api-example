<?php

namespace App\Support\Pagination;

use App\Support\Enums\PaginationTypeEnum;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder as SpatieQueryBuilder;

class PageBuilderFactory
{
    public function fromQuery(Builder|SpatieQueryBuilder $query, ?Request $request = null): AbstractPageBuilder
    {
        $request = $request ?: resolve(Request::class);

        return $request->input('pagination.type', config('pagination.default_type')) === PaginationTypeEnum::CURSOR->value
            ? new CursorPageBuilder($query, $request)
            : new OffsetPageBuilder($query, $request);
    }
}

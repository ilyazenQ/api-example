<?php

namespace App\Support\Enums;

/**
 * Pagination types:
 * * `cursor` - Пагинация используя cursor
 * * `offset` - Пагинация используя offset
 */
enum PaginationTypeEnum: string
{
    case CURSOR = 'cursor';
    case OFFSET = 'offset';
}

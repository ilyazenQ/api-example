<?php
namespace App\Actions;

use Illuminate\Http\Request;

class GetQueryStringFromReqAction implements Action
{
    public function execute(array $fields): string
    {
        $queryString = $fields["filter"]["queryString"];

        return $queryString;
    }
}

<?php

namespace App\Http\Controllers;

use App\Actions\CreatePostAction;
use App\Actions\DeletePostAction;
use App\Actions\PatchPostAction;
use App\Queries\PostQuery;
use App\Requests\CreatePostRequest;
use App\Requests\SearchPostRequest;
use App\Requests\UpdatePostRequest;
use App\Resources\EmptyResource;
use App\Resources\PostResource;
use App\Resources\PostsCollection;
use App\Support\Pagination\PageBuilderFactory;

class PostController extends Controller
{
    public function create(CreatePostRequest $request, CreatePostAction $action)
    {
        return new PostResource($action->execute($request->validated()));
    }

    public function patch(int $id, UpdatePostRequest $request, PatchPostAction $action)
    {
        return new PostResource($action->execute($id, $request->validated()));
    }

    public function get(int $id, PostQuery $query)
    {
        return new PostResource($query->findOrFail($id));
    }

    public function delete(int $id, DeletePostAction $action)
    {
        $action->execute($id);

        return new EmptyResource();
    }


    public function search(PageBuilderFactory $pageBuilderFactory, PostQuery $query)
    {
        return PostResource::collectPage(
            $pageBuilderFactory->fromQuery($query)->build()
        );
    }


}

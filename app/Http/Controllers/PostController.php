<?php

namespace App\Http\Controllers;

use App\Actions\CacheAllPostAction;
use App\Actions\ClearCacheWhenCreateAndDeleteAction;
use App\Actions\CreatePostAction;
use App\Actions\DeletePostAction;
use App\Actions\FindByElasticAction;
use App\Actions\PatchPostAction;
use App\Elastic\ElasticSearchPosts;
use App\Http\Requests\ElasticSearchPostRequest;
use App\Http\Resources\ElasticSearchPostsResource;
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

    public function getAll(PostQuery $query, CacheAllPostAction $action): PostsCollection
    {
        return new PostsCollection($action->execute($query));
    }

    public function delete(int $id, DeletePostAction $action)
    {
        $action->execute($id);

        return new EmptyResource();
    }

    public function search(PageBuilderFactory $pageBuilderFactory, PostQuery $query)
    {
        return new PostsCollection($query->paginate());
//        return PostResource::collectPage(
//            $pageBuilderFactory->fromQuery($query)->build()
//        );
    }
    public function searchByElastic(
        ElasticSearchPostRequest $request,
        FindByElasticAction $action,
        ElasticSearchPosts $elasticSearch
    ) {
        $posts = $action->execute($request->validated(), $elasticSearch);

        return new ElasticSearchPostsResource($posts);
    }

}

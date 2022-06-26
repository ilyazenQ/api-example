<?php

use Database\Factories\PostFactory;
use Tests\TestCase;
use App\Models\Post;
use function Pest\Laravel\postJson;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\patchJson;


it('should create a post', function () {

    $postData = PostFactory::new()->make()->toArray();

    $post = postJson(route('createPost'), $postData)
        ->assertStatus(201)
        ->assertJsonPath('data.slug', $postData['slug']);

    assertDatabaseHas((new Post())->getTable(), [
        'user_id' => $postData['user_id'],
        'slug' => $postData['slug'],
    ]);

});

it('should return 422 if slug is invalid when create', function () {

    $postData = PostFactory::new(['slug' => 'testslug'])->make()->toArray();

    $post = postJson(route('createPost'), $postData)
        ->assertStatus(201)
        ->assertJsonPath('data.slug', $postData['slug']);

    $post = postJson(route('createPost'), $postData)
        ->assertStatus(422);

});

it('should update a post', function () {
    $title = 'title';
    $body = 'body';

    $post = PostFactory::new()->create();
    $post = patchJson(route('patchPost', ['id' => $post->id]), [
        'title' => $title,
        'body' => $body
    ])
        ->assertStatus(200)
        ->assertJsonPath('data.title', $title)
        ->assertJsonPath('data.body', $body);

    assertDatabaseHas((new Post())->getTable(), [
        'title' => $title,
        'body' => $body,
    ]);

});

it('should return 422 if slug is invalid when update', function () {
    $slug = 'slug';
    $post = PostFactory::new(['slug' => $slug])->create();

    $postNew = PostFactory::new()->create();

    patchJson(route('patchPost', ['id' => $postNew->id]), [
        'slug' => $slug,
    ])
        ->assertStatus(422);
});

it('should return 404 if id doesnt exist when update', function () {

    patchJson(route('patchPost', ['id' => 100000000]), [
        'slug' => 'test',
    ])
        ->assertStatus(404);
});

it('should delete a post', function () {

    $post = PostFactory::new()->create();

    deleteJson("/api/posts/$post->id")
        ->assertStatus(200);

    assertDatabaseMissing($post->getTable(), [
        'id' => $post->id,
    ]);

});

it('should find 2 posts', function () {

    $post1 = PostFactory::new(['user_id' => 2])->create();
    $post2 = PostFactory::new(['user_id' => 2])->create();

    $response = postJson(route('searchPost'), [
        'filter' => [
            'user_id' => 2
        ]
    ])
        ->assertStatus(200)
        ->assertJsonPath('data', fn($data) => count($data) == 2);

});

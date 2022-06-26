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
        ->assertJsonPath('data.slug',$postData['slug']);

    assertDatabaseHas((new Post())->getTable(), [
        'user_id' => $postData['user_id'],
        'slug' => $postData['slug'],
    ]);

});

it('should return 422 if slug is invalid', function () {

    $postData = PostFactory::new(['slug'=>'testslug'])->make()->toArray();

    $post = postJson(route('createPost'), $postData)
        ->assertStatus(201)
        ->assertJsonPath('data.slug', $postData['slug']);

    $post = postJson(route('createPost'), $postData)
        ->assertStatus(422);

});


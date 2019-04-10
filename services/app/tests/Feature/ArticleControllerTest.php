<?php

namespace Tests;

use App\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

class ArticleControllerTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function testCreateArticle()
    {
        Storage::fake();

        $name = $this->faker->sentence();
        $body = $this->faker->paragraph();
        $image = $this->faker->imageUrl();

        $requestBody = compact('name', 'body', 'image');

        $this->post(route('articles.store'), $requestBody)->assertStatus(302);

        $article = Article::where('name', $requestBody['name'])->first();

        $this->assertEquals($body, $article->body);
        $this->assertTrue(Storage::exists($article->imagePath->append($article->image)));
    }

    public function testReadArticle()
    {
        factory(Article::class, 10)->create();

        $this->get(route('articles.index'))->assertStatus(200);
    }

    public function testUpdateArticle()
    {
        $article = factory(Article::class)->create();
        $articleId = $article->id;

        $requestBody = [
            'name' => $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
        ];

        $this->patch(route('articles.update', ['id' => $articleId]), $requestBody);

        $article->refresh();

        $this->assertEquals($requestBody['name'], $article->name);
        $this->assertEquals($requestBody['body'], $article->body);
    }

    public function testDeleteArticle()
    {
        $article = factory(Article::class)->create();
        $articleId = $article->id;

        $this->delete(route('articles.destroy', ['id' => $articleId]));

        $this->assertFalse(Article::where('id', $articleId)->exists());
    }
}

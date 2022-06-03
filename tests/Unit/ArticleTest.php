<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Article;

class ArticleTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_post(){
        
        $data = [
            'title' => 'sdsdsds',
            'content' => 'dfdfdfddf',
            'image' => 'img.png',
            'category_id' => '1',
            'user_id' => '1',
        ];
        $this->post(route('article.store'), $data)->assertStatus(201)->assertJson($data);
      }
    
      public function test_update_article(){
        $article = Article::factory()->create();
        $data = [
            'title' => 'sdsdsds',
            'content' => 'sdsdsdsds',
            'image' => 'img.png',
            'category_id' => '1',
            'user_id' => '1',
        ];
        $this->post(route('article.update', 1), $data)
            ->assertStatus(200)
            ->assertJson($data);
      }
    
      public function test_show_post(){
        $article = Article::factory()->create();
        $this->get(route('article.show', 1))->assertStatus(200);
      }
    
    
    //   public function test_delete_post(){
    //     $article = Article::factory()->create();
    //     $this->delete(route('article.delete', $article->id))
    //         ->assertStatus(204);
    //   }
    
      public function test_list_posts(){
        $article = Article::factory()->create()->map(function ($article) {
            return $article->only(['id', 'title', 'content']);
        });
        $this->get(route('article'))
            ->assertStatus(200)
            ->assertJson($article->toArray())
            ->assertJsonStructure([
                '*' => [ 'id', 'title', 'content' ],
            ]);
      }
}

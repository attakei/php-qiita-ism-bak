<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Article;


class ArticleControllerTest extends TestCase
{
    protected function injectFixtures()
    {
        DB::transaction(function ()
        {
            User::create(['name'=>'test_user_1', 'email' => 'user1@example.com', 'password' => '']);
            User::create(['name'=>'test_user_2', 'email' => 'user2@example.com', 'password' => '']);
            Article::create(['title' => 'test title', 'body' => 'test', 'status' => 'draft', 'author_id' => 1,]);
            Article::create(['title' => 'test title2', 'body' => 'test', 'status' => 'internal', 'author_id' => 1,]);
        });

    }

    /**
     * 自分の投稿は自由にみられること
     *
     * @return void
     */
    public function testVisibleOwn()
    {
        $this->injectFixtures();
        $this->be(User::find(1));
        $response = $this->action('GET', 'ArticleController@getOne', ['articleId' => 1]);
        $this->assertEquals($response->getStatusCode(), 200);
        $response = $this->action('GET', 'ArticleController@getOne', ['articleId' => 2]);
        $this->assertEquals($response->getStatusCode(), 200);
    }

    /**
     * 自分以外の投稿のうち、下書きはみられないこと
     *
     * @return void
     */
    public function testOther()
    {
        $this->injectFixtures();
        $this->be(User::find(2));
        $response = $this->action('GET', 'ArticleController@getOne', ['articleId' => 1]);
        $this->assertEquals($response->getStatusCode(), 200);
        $response = $this->action('GET', 'ArticleController@getOne', ['articleId' => 2]);
        $this->assertEquals($response->getStatusCode(), 404);
    }
}

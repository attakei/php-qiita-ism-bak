<?php

namespace App\Http\Controllers;

use Validator;
use Auth;
use DB;
use App\Http\Requests;
use App\Article;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    const ITEMS_PER_PAGE = 20;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display new article form
     */
    public function newForm()
    {
        return view('article.form', [
                'article' => new Article(['status' => 'draft']),
            ]
        );
    }

    public function editForm($articleId)
    {
        $article = Article::find($articleId);
        // If article is not found, abort request.
        if ( is_null($article) ) {
            return abort(404);
        }
        return view('article.form', [
            'article' => $article,
        ]);

    }

    public function postOne(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'articleTitle' => 'required',
            'articleBody' => 'required',
            'articleStatus' => 'required',
            ]
        );
        // If validate is NG, return form view
        if ( $validator->fails() ) {
            return view('article.form', ['errors' => $validator->errors()]);
        }

        // Post validated values
        $params = [
            'title' => $request->input('articleTitle'),
            'body' => $request->input('articleBody'),
            'status' => $request->input('articleStatus'),
        ];
        if ($request->input('_article_id')) {
            $article = Article::find($request->input('_article_id'));
            $message = 'Article is updated';
        } else {
            $article = Article::create(['author_id' => Auth::user()->id]);
            $message = 'New article is created';
        }
        foreach ($params as $attr => $val) {
            $article->{$attr} = $val;
        }
        DB::transaction(function () use ($article, $request, $message)
        {
            $article->save();
            $request->session()->flash('flash_message', $message);
        });
        return redirect(route('get_article_single', ['articleId' => $article->id]));
    }

    public function getOne($articleId)
    {
        $article = Article::find($articleId);
        // If article is not found, abort request.
        if ( is_null($article) ) {
            return abort(404);
        }

        // Render article
        return view('article.single', [
            'article' => $article,
            'parser' => new \cebe\markdown\GithubMarkdown(),
        ]);
    }

    /**
     * 表示可能な記事リストを表示する
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        // TODO: Move to model method
        $articles = Article::latest()->where('status', 'internal')->paginate(static::ITEMS_PER_PAGE);

        // TODO: If $articles is not values ?


        // Render articles
        return view('article.list', [
            'articles' => $articles,
        ]);
    }
}

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
        return view('article.form');
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
            'author_id' => Auth::user()->id,
            'title' => $request->input('articleTitle'),
            'body' => $request->input('articleBody'),
            'status' => $request->input('articleStatus'),
        ];
        $article = Article::create($params);
        DB::transaction(function () use ($article, $request)
        {
            $article->save();
            $request->session()->flash('flash_message', 'New article is created');
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

    public function getList()
    {
        $articles = Article::latest()->where('status', 'internal')->offset(0)->limit(10)->get();

        // Render articles
        return view('article.list', [
            'articles' => $articles,
        ]);
    }
}

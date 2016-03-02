@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>List of articles (/)</h1>
    </div>
    <div class="row">
        @foreach($articles as $article)
        <p><a href="{{ route('get_article_single', $article->id) }}">{{ $article->title }}</a></p>
        @endforeach
    </div>
</div>
@endsection

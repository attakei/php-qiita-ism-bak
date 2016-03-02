@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>{{ $article->title }}</h1>
        {{-- フラッシュメッセージの表示 --}}
        @if (Session::has('flash_message'))
        <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
        @endif
    </div>
    <div class="row">
        {!! $parser->parse($article->body) !!}
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>新規投稿追加</h1>
        <div class="col-md-10">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <input class="form-control" type="text" name="articleTitle" placeholder="Title ?">
                </div>
                <div class="form-group">
                    <textarea name="articleBody" data-provide="markdown" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label class="radio-inline">
                      <input type="radio" name="articleStatus" id="articleStatusDraft" value="draft" checked> 下書きのまま
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="articleStatus" id="articleStatusInternal" value="internal"> 社内公開する
                    </label>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">保存する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('page_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.10.0/css/bootstrap-markdown.min.css" rel="stylesheet">
@endsection

@section('page_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-markdown/2.10.0/js/bootstrap-markdown.min.js"></script>
@endsection
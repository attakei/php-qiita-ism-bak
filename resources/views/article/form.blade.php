@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>新規投稿追加</h1>
        <div class="col-md-10">
            <form>
                <label>タイトル</label>
                <input class="form-control" type="text" placeholder="Default input">
                <div>
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">編集</a></li>
                    <li role="presentation"><a href="#preview" aria-controls="preview" role="tab" data-toggle="tab">プレビュー</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="edit">
                        <textarea name="articleBody"></textarea>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="preview"></div>
                  </div>

                </div>

                <button type="button" class="btn btn-default btn-lg active">保存する</button>
            </form>
        </div>
    </div>
</div>
@endsection

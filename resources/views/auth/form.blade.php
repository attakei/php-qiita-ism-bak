@extends('_layout.page')

@section('main')
<!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron">
    <h2>認証</h2>
    <form method="post" style="width:50%;">
        <div class="form-group">
            <label for="authEmail">Email address</label>
            <input type="email" class="form-control" id="authEmail" name="email" placeholder="Email">
        </div>
        <button type="button" class="btn btn-default" id="submitAuth">サインアップ/ログイン</button>
    </form>
</div>
@endsection


@section('js')
<script>
    $('#submitAuth').click(function(event){
        var formData = {};
        formData['email'] = $('#authEmail')[0].value;
        $.ajax({
            data: formData,
            dataType: 'json',
            beforeSend: function(xhr) {
                event.target.innerHTML = '認証中';
            },
            complete: function(xhr, textStatus) {
                event.target.innerHTML = 'サインアップ/ログイン';
            },
            error: function(xhr, status, err) {
                if (xhr.status == 401) {
                    msg = '';
                }
                console.log();
            },
            success: function(data, dataType) {
                console.log('OK');
                if (typeof data.token !== 'undefined') {
                    Cookies.set('token', data.token);
                }
                if (typeof data.nextUrl !== 'undefined') {
                    location.href = data.nextUrl;
                    return;
                }
            },
            type: 'POST',
        });
    });
</script>
@endsection

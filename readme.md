# PHP Qiita-ism (仮)

PHPで実装された、プライベート環境向けQiita系サイトです

## 動かす

### 必要環境

* Laravel 5.2系が動くPHP
* RDBサービス(MySQL, SQLite)

### 動かし方

```bash
$ composer install --no-scripts --no-dev
$ php artisan migrate
$ php artisan serve
```

## 運用環境デプロイ

masterブランチは原則、いつ運用環境に反映されてもいいようにしてください

### 事前に

なるべく次のことは確認してください

* PHPUnitで既存テストが一通り通ること
* artisanでのビルトインサーバで簡単な動作ができていること

## ブランチ運用(暫定版)

* master
    * リリース対象ブランチ。基本的にこのブランチはいつ運用環境にデプロイされてしまってもいいようにしておく
* release/XXX
    * リリース後ブランチ。ドキュメント修正や簡単な文言調整はこちらで？
* develop/XXX
    * 開発ブランチ
* feature/XXX/YYY
    * 開発ブランチ(単機能)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

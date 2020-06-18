# momonara

学生時代に練習で作成したLaravelを使用した「3DCGの知識共有サイト」。

イメージとしては、qiitaの3dcg版の用な感じです。

## 注意点

初回起動時にはマイグレーションを行ってください。

```
php artisan migrate
```

Laravel側で画像や動画などがあるファイルへのアクセスリンクを作成するための下記のコマンドが必要です。

```
php artisan storage:link
```
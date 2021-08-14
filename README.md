# programing-learning-web
プログラミング学習Webサイト開発

## 開発環境構築

```
$ git clone https://github.com/k-sasaking/programing-learning-web.git
$ cd programing-learning-web
$ docker-compose up --build -d  # Dockerコンテナ起動 -> web, app, mysql
$ cp src/.env.local src/.env
$ docker-compose exec app bash  # appコンテナにログイン
[app] $ composer install  # ライブラリをインストール
Package manifest generated successfully.
[app] $ php artisan migrate  # マイグレーションを実行
Migration table created successfully.
[app] $ php artisan db:seed # テストデータを登録
```

[http://localhost:8081](http://localhost:8081)


※composerやphp artisanなどのコマンドは、dockerのappコンテナにログインして実行するようにしてください。

## Githubの使い方

- main: 本番用
- develop: 開発用（こちらにマージする）
- feature: 個人のタスク


- 1 developブランチからfeatureブランチを作成（例：feature/login)
- 2 機能実装->add->commit->push
- 3 githubページよりプルリクを作成
- 4 issueにてプルリク作成したこと記載

test

test2

test3

test4

test5
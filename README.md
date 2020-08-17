# 起動コマンド
`git clone https://github.com/kodakoda0921/matching.git`

`cd matching`

`docker-compose build`

`docker-compose up -d`

`docker-compose exec php composer install`

`docker-compose exec php php artisan migrate`

`docker-compose exec php php artisan db:seed`

`docker-compose exec php php artisan storage:link `


# コマンド入力後

`http://localhost:8080`にアクセス


# 動作確認後

以下コマンドを入力（コンテナを閉じる）。

`docker-compose down`

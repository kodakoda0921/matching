# 起動コマンド
1.git clone https://github.com/kodakoda0921/matching.git

2.cd matching

3.docker-compose build

4.docker-compose up d

5.docker-compose exec php composer install

6.docker-compose exec php php artisan migrate

7.docker-compose exec php php artisan db:seed


# コマンド入力後

localhost:8080にアクセス


# 動作確認後

以下コマンドを入力（コンテナを閉じる）。

1.docker-compose down

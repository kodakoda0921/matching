# 起動コマンド
sudo yum install --enablerepo=remi,remi-php72 php-pecl-zip

git clone https://github.com/kodakoda0921/matching.git

cd matching

docker-compose build

docker-compose up d

docker-compose exec php composer install

docker-compose exec php php artisan migrate

docker-compose exec php php artisan db:seed


# コマンド入力後

localhost:8080にアクセス


# 動作確認後

以下コマンドを入力（コンテナを閉じる）。

1.docker-compose down

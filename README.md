# mogitate

## 環境構築

### Docker ビルド

1.  リポジトリをクローン
    ```bash
    git clone git@github.com:Estra-Coachtech/laravel-docker-template.git
    ```
2.  ビルドして起動

    ```bash
    docker-compose up -d --build

    ```

- Note:
  MySQL は、OS によって起動しない場合があるのでそれぞれの PC に合わせて 　 docker-compose.yml ファイルを編集してください。

### Laravel 環境構築

1. docker-compose exec php bash
2. composer install
3. env.example ファイルから.env を作成し、環境変数を変更
4. php artisan key:generate
5. php artisan migrate
6. php artisan db:seed

## 使用技術

- PHP 8.1.33
- Laravel 8.83.8
- MySQL 15.2

## ER 図

![ER図](docs/ER.drawio.png)

## URL

- 環境開発：<http://localhost/>
- phpMyAdmin：<http://localhost:8080/>

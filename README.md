# FashionablyLate

お問い合わせフォームと管理画面を備えたLaravelアプリケーションです。

## 環境構築

### Dockerビルド

1. リポジトリをクローンします。

```bash
git clone https://github.com/taka-h8412/fashionably-late.git
```

2. プロジェクトディレクトリへ移動します。

```bash
cd fashionably-late
```

3. 環境変数ファイルを作成します。

```bash
cp .env.example .env
```

4. Composerパッケージをインストールします。

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    -e COMPOSER_CACHE_DIR=/tmp/composer_cache \
    laravelsail/php85-composer:latest \
    composer install --ignore-platform-reqs
```

5. `.env` のデータベース設定を次のように変更します。

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

6. Dockerコンテナを起動します。

```bash
./vendor/bin/sail up -d
```

### Laravel環境構築

1. アプリケーションキーを生成します。

```bash
./vendor/bin/sail artisan key:generate
```

2. マイグレーションとシーディングを実行します。

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

## 使用技術（実行環境）

- PHP 8.5.5
- Laravel 10.50.2
- MySQL 8.4.9

## ER図

```mermaid
erDiagram
    categories {
        bigint id PK
        varchar content "NOT NULL"
        timestamp created_at
        timestamp updated_at
    }

    contacts {
        bigint id PK
        bigint categry_id FK "NOT NULL"
        varchar first_name "NOT NULL"
        varchar last_name "NOT NULL"
        tinyint gender "NOT NULL"
        varchar email "NOT NULL"
        varchar tel "NOT NULL"
        varchar address "NOT NULL"
        varchar building
        text detail "NOT NULL"
        timestamp created_at
        timestamp updated_at
    }

    users {
        bigint id PK
        varchar name "NOT NULL"
        varchar email "NOT NULL"
        varchar password "NOT NULL"
        timestamp created_at
        timestamp updated_at
    }

    categories ||--o{ contacts : relation
```

## URL

- お問い合わせ入力画面：`http://localhost/`
- 会員登録画面：`http://localhost/register`
- ログイン画面：`http://localhost/login`
- 管理画面：`http://localhost/admin`

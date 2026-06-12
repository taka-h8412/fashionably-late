<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        // 管理画面の一覧・検索・ページネーション確認用にダミーデータ35件作成
        Contact::factory()->count(35)->create();
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        $faker = \Faker\Factory::create('ja_JP'); // fakerを日本語設定で使用

        $categryId = $faker->numberBetween(1, 5); // お問い合わせ種類

        $details = [
            1 => '商品がまだ届いていないため、配送状況を確認したいです。',
            2 => '商品のサイズが合わなかったため、交換を希望します。',
            3 => '商品に破損があったため、返品または返金対応をお願いします。',
            4 => 'ショップの営業時間について教えてください。',
            5 => 'その他の内容について問い合わせです。',
        ];

        $buildings = [
            null, // nullは未入力想定
            'テストマンション101',
            'テストビル202',
            'テスト団地303',
            'テストアパート405',
        ];

        return [
            'categry_id' => $categryId, // 仕様書のカラム名 categry_id
            'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'gender' => $faker->numberBetween(1, 3),
            'email' => $faker->unique()->safeEmail(),
            'tel' => '090' . $faker->numberBetween(10000000, 99999999), // 090 + 8桁の数字
            'address' => $faker->prefecture() . $faker->city() . $faker->streetAddress(), // 都道府県＋市区町村＋番地
            'building' => $faker->randomElement($buildings),
            'detail' => $details[$categryId], // お問い合わせ種類に対応した内容を入れる
        ];
    }
}

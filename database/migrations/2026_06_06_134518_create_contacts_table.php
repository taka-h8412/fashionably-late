<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categry_id')->constrained('categories')->cascadeOnDelete(); // 仕様書のカラム名 categry_id
            $table->string('first_name');
            $table->string('last_name');
            $table->tinyInteger('gender'); // 1:男性 2:女性 3:その他
            $table->string('email');
            $table->string('tel'); // フォームで3分割入力、保存時に結合
            $table->string('address');
            $table->string('building')->nullable(); // 未入力許可
            $table->text('detail');
            $table->timestamps(); // created_at と updated_at を自動作成
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};

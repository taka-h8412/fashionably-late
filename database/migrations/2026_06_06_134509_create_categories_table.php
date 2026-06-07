<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('content'); // お問い合わせ種類
            $table->timestamps(); // created_at と updated_at を自動作成
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

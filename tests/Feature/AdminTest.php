<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_index_can_display(): void
    {
        $user = User::create([
            'name' => '山田 太郎',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        Category::create([
            'content' => '商品のお届けについて',
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
        $response->assertViewIs('admin.index');
        $response->assertViewHas('contacts');
        $response->assertViewHas('categories');
    }

    public function test_admin_search_can_display_results(): void
    {
        $user = User::create([
            'name' => '山田 太郎',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $category = Category::create([
            'content' => '商品のお届けについて',
        ]);

        Contact::create([
            'last_name' => '山田',
            'first_name' => '太郎',
            'gender' => '1',
            'email' => 'test@example.com',
            'tel' => '09012345678',
            'address' => '東京都渋谷区',
            'building' => 'テストマンション101',
            'categry_id' => $category->id,
            'detail' => '検索テストです',
        ]);

        $response = $this->actingAs($user)->get('/search?keyword=山田');

        $response->assertStatus(200);
        $response->assertViewIs('admin.index');
        $response->assertViewHas('contacts');
        $response->assertViewHas('categories');
    }

    public function test_admin_can_delete_contact(): void
    {
        $user = User::create([
            'name' => '山田 太郎',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $category = Category::create([
            'content' => '商品のお届けについて',
        ]);

        $contact = Contact::create([
            'last_name' => '山田',
            'first_name' => '太郎',
            'gender' => '1',
            'email' => 'test@example.com',
            'tel' => '09012345678',
            'address' => '東京都渋谷区',
            'building' => 'テストマンション101',
            'categry_id' => $category->id,
            'detail' => '削除テストです',
        ]);

        $response = $this->actingAs($user)->post('/delete', [
            'id' => $contact->id,
        ]);

        $response->assertRedirect('/admin');

        $this->assertDatabaseMissing('contacts', [
            'id' => $contact->id,
        ]);
    }

    public function test_admin_can_export_csv(): void
    {
        $user = User::create([
            'name' => '山田 太郎',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $category = Category::create([
            'content' => '商品のお届けについて',
        ]);

        Contact::create([
            'last_name' => '山田',
            'first_name' => '太郎',
            'gender' => '1',
            'email' => 'test@example.com',
            'tel' => '09012345678',
            'address' => '東京都渋谷区',
            'building' => 'テストマンション101',
            'categry_id' => $category->id,
            'detail' => 'CSVテストです',
        ]);

        $response = $this->actingAs($user)->get('/export');

        $response->assertStatus(200);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_index_can_display(): void
    {
        Category::create([
            'content' => '商品のお届けについて',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('contact.index');
        $response->assertViewHas('categories');
    }

    public function test_contact_confirm_can_display_with_valid_data(): void
    {
        $category = Category::create([
            'content' => '商品のお届けについて',
        ]);

        $response = $this->post('/confirm', [
            'last_name' => '山田',
            'first_name' => '太郎',
            'gender' => '1',
            'email' => 'test@example.com',
            'tel1' => '090',
            'tel2' => '1234',
            'tel3' => '5678',
            'address' => '東京都渋谷区',
            'building' => 'テストマンション101',
            'categry_id' => $category->id,
            'detail' => 'テストお問い合わせ内容です',
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('contact.confirm');
        $response->assertViewHas('contact');
        $response->assertViewHas('category');
    }

    public function test_contact_confirm_validation_errors_with_empty_data(): void
    {
        $response = $this->post('/confirm', []);

        $response->assertSessionHasErrors([
            'last_name',
            'first_name',
            'gender',
            'email',
            'tel1',
            'tel2',
            'tel3',
            'address',
            'categry_id',
            'detail',
        ]);
    }

    public function test_contact_can_store(): void
    {
        $category = Category::create([
            'content' => '商品のお届けについて',
        ]);

        $response = $this->post('/thanks', [
            'last_name' => '山田',
            'first_name' => '太郎',
            'gender' => '1',
            'email' => 'test@example.com',
            'tel' => '09012345678',
            'address' => '東京都渋谷区',
            'building' => 'テストマンション101',
            'categry_id' => $category->id,
            'detail' => 'テストお問い合わせ内容です',
        ]);

        $response->assertStatus(200);
        $response->assertViewIs('contact.thanks');

        $this->assertDatabaseHas('contacts', [
            'last_name' => '山田',
            'first_name' => '太郎',
            'email' => 'test@example.com',
            'tel' => '09012345678',
            'categry_id' => $category->id,
            'detail' => 'テストお問い合わせ内容です',
        ]);
    }
}
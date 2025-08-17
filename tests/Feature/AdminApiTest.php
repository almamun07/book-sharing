<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminApiTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;
    protected $user;
    protected $book;

    protected function setUp(): void
    {
        parent::setUp();

        // Admin user
        $this->admin = User::factory()->create([
            'role' => 'admin'
        ]);

        // Normal user
        $this->user = User::factory()->create([
            'role' => 'user'
        ]);

        // Book
        $this->book = Book::factory()->create();
    }

    /** @test */
    public function admin_can_view_users()
    {
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/admin/users');
        $response->assertStatus(200);
        $response->assertJsonFragment(['email' => $this->user->email]);
    }

    /** @test */
    public function admin_can_view_books()
    {
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/admin/books');
        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $this->book->id]);
    }

    /** @test */
    public function admin_can_delete_book()
    {
        Sanctum::actingAs($this->admin);

        $response = $this->deleteJson('/api/admin/books/' . $this->book->id);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Book deleted successfully']);

        $this->assertDatabaseMissing('books', ['id' => $this->book->id]);
    }

    /** @test */
    public function non_admin_cannot_access_admin_apis()
    {
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/admin/users');
        $response->assertStatus(403);

        $response = $this->getJson('/api/admin/books');
        $response->assertStatus(403);

        $response = $this->deleteJson('/api/admin/books/' . $this->book->id);
        $response->assertStatus(403);
    }
}

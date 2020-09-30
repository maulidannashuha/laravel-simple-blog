<?php

namespace Tests\Feature\Http\Controller\Post;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditPostControllerTest extends TestCase
{
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUsingValidData()
    {
        $post = Post::factory()->create();
        $category = Category::factory()->create();

        $response = $this->from(route("posts.edit", $post->id))
            ->post(route("posts.update", $post->id), [
                "title" => $this->faker->words(3, true),
                "category_id" => $category->id,
                "content" => $this->faker->text,
                "_method" => "put",
            ]);

        $response->assertStatus(302);
        $response->assertRedirect(route("posts.index"));
    }
}
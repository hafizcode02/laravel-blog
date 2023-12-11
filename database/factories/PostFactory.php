<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence;
        $isPublished = ['1', '0'];
        return [
            'user_id' => rand(1, 5),
            'title' => $title,
            'slug' => str_slug($title),
            'sub_title' => $this->faker->sentence,
            'details' => $this->faker->paragraph,
            'post_type' => 'post',
            'is_published' => $isPublished[rand(0, 1)],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

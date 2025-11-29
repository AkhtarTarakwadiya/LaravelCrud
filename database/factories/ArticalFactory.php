<?php

namespace Database\Factories;

use App\Models\Artical;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticalFactory extends Factory
{
    protected $model = Artical::class;

    public function definition()
    {
        $title = $this->faker->sentence;

        return [
            'title'       => $title,
            'content'     => $this->faker->paragraph(5),
            // 'user_id'     => User::inRandomOrder()->value('id') ?? User::factory(),
            'image_path'  => null, // or: 'images/' . $this->faker->image('storage/app/public/images', 640, 480, null, false)
            'slug'        => Str::slug($title) . '-' . Str::random(5),
        ];
    }
}

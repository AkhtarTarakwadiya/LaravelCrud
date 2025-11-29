<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artical;

class ArticalSeeder extends Seeder
{
    public function run()
    {
        Artical::factory()->count(100)->create();
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Posts;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker\Factory::create();

      for ($i=0; $i < 10; $i++) {
        $post = new Posts();
        $post -> title = $faker->name;
        $post -> content = $faker->text;
        $post -> groups_id = $faker->randomDigitNotNull;
        $post -> users_id = $faker->randomDigitNotNull;
        $post -> rating = $faker->randomDigitNotNull;
        $post -> save();
      }

    }
}

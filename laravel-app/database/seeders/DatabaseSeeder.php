<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Food;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        //disable foreign key check for this connection before running seeders
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('Posts')->delete();
        \App\Models\Post::factory(50)->create();

        // $this->call('CategoriesTableSeeder');
        // $this->command->info('Categories table seeded');

        DB::table('Categories')->delete();
        $categories = [
            ['id' => 1, 'name' => 'Food of Japan', 'description' => 'Sushi,ramen,Sukiyaki,Onigiri ', 'created_at'=> now(),'updated_at'=> now()],
            ['id' => 2, 'name' => 'Food of Vietnam', 'description' => 'Pho, bun dau, nem ran','created_at'=> now(),'updated_at'=> now()],
        ];
        Category::insert($categories);

        DB::table('foods')->delete();
        $foods = [
            ['id' => 1, 'name' => 'Sushi 1', 'count' => 5, 'description' => 'Sushi', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 2, 'name' => 'Onigiri 2', 'count' => 8, 'description' => 'Onigiri', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 3, 'name' => 'Pho 3', 'count' => 8, 'description' => 'Pho ha noi', 'category_id' => 2,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 4, 'name' => 'Sushi 4', 'count' => 5, 'description' => 'Sushi', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 5, 'name' => 'Onigiri 5', 'count' => 8, 'description' => 'Onigiri', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 6, 'name' => 'Pho 6', 'count' => 8, 'description' => 'Pho ha noi', 'category_id' => 2,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 7, 'name' => 'Sushi 7', 'count' => 5, 'description' => 'Sushi', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 8, 'name' => 'Onigiri 8', 'count' => 8, 'description' => 'Onigiri', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 9, 'name' => 'Pho 9', 'count' => 8, 'description' => 'Pho ha noi', 'category_id' => 2,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 10, 'name' => 'Sushi 10', 'count' => 5, 'description' => 'Sushi', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 11, 'name' => 'Onigiri 11', 'count' => 8, 'description' => 'Onigiri', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 12, 'name' => 'Pho 12', 'count' => 8, 'description' => 'Pho ha noi', 'category_id' => 2,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 13, 'name' => 'Sushi 13', 'count' => 5, 'description' => 'Sushi', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 14, 'name' => 'Onigiri 14', 'count' => 8, 'description' => 'Onigiri', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 15, 'name' => 'Pho 15', 'count' => 8, 'description' => 'Pho ha noi', 'category_id' => 2,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 16, 'name' => 'Sushi 16', 'count' => 5, 'description' => 'Sushi', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 17, 'name' => 'Onigiri 17', 'count' => 8, 'description' => 'Onigiri', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 18, 'name' => 'Pho 18', 'count' => 8, 'description' => 'Pho ha noi', 'category_id' => 2,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 19, 'name' => 'Sushi 19', 'count' => 5, 'description' => 'Sushi', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 20, 'name' => 'Onigiri 20', 'count' => 8, 'description' => 'Onigiri', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 21, 'name' => 'Pho 21', 'count' => 8, 'description' => 'Pho ha noi', 'category_id' => 2,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 22, 'name' => 'Sushi 22', 'count' => 5, 'description' => 'Sushi', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 23, 'name' => 'Onigiri 23', 'count' => 8, 'description' => 'Onigiri', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 24, 'name' => 'Pho 24', 'count' => 8, 'description' => 'Pho ha noi', 'category_id' => 2,'created_at'=> now(),'updated_at'=> now()],
        ];
        Food::insert($foods);

        // supposed to only apply to a single connection and reset it's self
        // but I like to explicitly undo what I've done for clarity
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->call([
            UserTableSeeder::class,
        ]);
    }
}


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
            ['id' => 1, 'name' => 'Sushi', 'count' => 5, 'description' => 'Sushi', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 2, 'name' => 'Onigiri', 'count' => 8, 'description' => 'Onigiri', 'category_id' => 1,'created_at'=> now(),'updated_at'=> now()],
            ['id' => 3, 'name' => 'Pho', 'count' => 8, 'description' => 'Pho ha noi', 'category_id' => 2,'created_at'=> now(),'updated_at'=> now()],
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


<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\BlogImage;
use App\Models\Blog;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogs')->delete();
        $content = "<p>Sed porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Sed porttitor lectus nibh. Donec sollicitudin molestie malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Proin eget tortor risus. Donec rutrum congue leo eget malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Donec sollicitudin molestie malesuada. Nulla quis lorem ut libero malesuada feugiat. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem</p><h3>The corner window forms a place within a place that is a resting point within the large space.</h3><p>The study area is located at the back with a view of the vast nature. Together with the other buildings, a congruent story has been managed in which the whole has a reinforcing effect on the components. The use of materials seeks connection to the main house, the adjacent stables</p>";
        $blogs = [
            ['id' => 1, 'name' => 'blog-1', 'food_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'content' => $content,],
            ['id' => 2, 'name' => 'blog-2', 'food_id' => 2, 'created_at' => now(), 'updated_at' => now(), 'content' => $content,],
        ];
        Blog::insert($blogs);

        // DB::table('blogImages')->delete();
        // $blogImages = [
        //     ['id' => 1, 'name' => 'blog-1-image-1', 'blog_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'order' => '1','image_path'=>'blog/details/detail-4.png'],
        //     ['id' => 2, 'name' => 'blog-1-image-2', 'blog_id' => 1, 'created_at' => now(), 'updated_at' => now(), 'order' => '2','image_path'=>'blog/details/detail-3.png'],
        //     ['id' => 3, 'name' => 'blog-2-image-1', 'blog_id' => 2, 'created_at' => now(), 'updated_at' => now(), 'order' => '1','image_path'=>'blog/details/detail-4.png'],
        // ];
        // BlogImage::insert($blogImages);
    }
}

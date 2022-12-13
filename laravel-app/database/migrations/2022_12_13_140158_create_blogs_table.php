<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->longText('content')->nullable();
            $table->integer('food_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('blogImages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('order')->unsigned();
            $table->timestamps();

            //foreign keys
            $table->unsignedInteger('blog_id');
            $table->foreign('blog_id')
                ->references('id')
                ->on('blogs')
                ->onDelete('cascade');
            //-> ->onDelete('set null')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
        Schema::dropIfExists('blogImages');
    }
};

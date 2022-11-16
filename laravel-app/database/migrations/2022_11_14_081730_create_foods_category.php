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
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('count')->unsigned();
            $table->longText('description')->nullable();
            $table->timestamps();

            //foreign keys
            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
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
        Schema::dropIfExists('foods');
        Schema::dropIfExists('categories');
    }
};

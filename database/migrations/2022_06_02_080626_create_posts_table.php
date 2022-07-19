<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by_user_id');
            $table->text('category_id')->nullable();
            //$table->unsignedBigInteger('author_id')->nullable();
            $table->text('title')->nullable();
            $table->text('title_in_english')->nullable();
            //$table->text('content')->nullable();
            $table->mediumText('content')->nullable();
            $table->timestamps();

            $table->foreign('created_by_user_id')->references('id')->on('users');
            //$table->foreign('category_id')->references('id')->on('posts_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_category', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->string('category_name_bangla')->nullable();
            $table->string('category_slug')->nullable();
            $table->string('category_slug_bangla')->nullable();
            $table->unsignedBigInteger('created_by_user_id');
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->timestamps();

            $table->softDeletes();
            
            $table->foreign('created_by_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_category');
    }
}

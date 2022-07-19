<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // tomorrow work on here
        //https://www.tagoreweb.in/Songs/chitrangoda-gitabitan-513/thak-thak-keno-michhe-9506
        Schema::create('posts_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->string('rag', 64)->nullable();
            $table->string('tal')->nullable();
            $table->string('composition_time_bangla')->date()->default(NULL);
            $table->string('composition_time_english')->date()->default(NULL);
            $table->string('composition_place')->nullable();
            $table->string('notation')->nullable(); // shorolipikar
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_details');
    }
}

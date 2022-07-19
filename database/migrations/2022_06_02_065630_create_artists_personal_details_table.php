<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsPersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists_personal_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artists_id');
            $table->string('gender', 16)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->timestamps();
            
            $table->foreign('artists_id')->references('id')->on('artists')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artists_personal_details');
    }
}

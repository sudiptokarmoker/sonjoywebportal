<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComposerPersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composer_personal_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('composer_id');
            $table->string('gender', 16)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->timestamps();
            
            $table->foreign('composer_id')->references('id')->on('composer')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('composer_personal_details');
    }
}

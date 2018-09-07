<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentImgs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_imgs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id');
            $table->string('img');
            $table->integer('order')->nullable();
            $table->timestamps();
            $table->index('content_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_imgs');
    }
}

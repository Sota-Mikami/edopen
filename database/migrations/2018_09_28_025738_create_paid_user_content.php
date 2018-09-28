<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaidUserContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_user_content',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('paid_user_id');
            $table->unsignedInteger('content_id');
            $table->timestamps();

            $table->foreign('paid_user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
            $table->foreign('content_id')
                    ->references('id')
                    ->on('content')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paid_user_content');
    }
}

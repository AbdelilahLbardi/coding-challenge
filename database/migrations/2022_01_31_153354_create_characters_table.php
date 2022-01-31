<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->unique();
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('nickname')->nullable();
            $table->json('occupation')->nullable();
            $table->boolean('status')->nullable();
            $table->string('category')->nullable();
            $table->json('seasons')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}

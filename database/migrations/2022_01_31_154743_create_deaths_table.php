<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deaths', function (Blueprint $table) {
            $table->bigInteger('id')->unsigned()->unique();
            $table->bigInteger('character_id')->unsigned()->index();
            $table->bigInteger('responsible_id')->unsigned()->index();
            $table->text('cause');
            $table->text('last_words');
            $table->tinyInteger('season');
            $table->tinyInteger('episode');
            $table->tinyInteger('death_caused_count');
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
        Schema::dropIfExists('deaths');
    }
}

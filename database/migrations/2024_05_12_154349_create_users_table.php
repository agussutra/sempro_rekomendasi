<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->string('hobby');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('favorite_song_1')->nullable();
            $table->string('favorite_song_2')->nullable();
            $table->string('favorite_song_3')->nullable();
            $table->string('favorite_song_4')->nullable();
            $table->string('favorite_song_5')->nullable();
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
        Schema::dropIfExists('users');
    }
}

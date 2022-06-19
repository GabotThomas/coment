<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->enum('status', ['unfinish', 'current', 'finish'])->default('unfinish');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('level_id')->references('id')->on('level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level_users');
    }
}

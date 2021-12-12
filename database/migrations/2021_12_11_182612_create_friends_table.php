<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendsTable extends Migration {
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('friends', function (Blueprint $table) {

            $table->id();
            $table->boolean('accepted')->default('0');
            $table->timestamps();

            //Foreign Keys
            $table->unsignedBigInteger('userId1');
            $table->foreign('userId1', 'fk_friends1_users')
            ->on('users')
            ->references('id')
            ->onDelete('cascade');

            $table->unsignedBigInteger('userId2');
            $table->foreign('userId2', 'fk_friends2_users')
            ->on('users')
            ->references('id')
            ->onDelete('cascade');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::dropIfExists('friends');

    }

}

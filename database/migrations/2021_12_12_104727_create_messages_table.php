<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('messages', function (Blueprint $table) {

            $table->id();
            $table->string('message');
            $table->timestamps();

             //Foreign Keys
            $table->unsignedBigInteger('from');
            $table->foreign('from', 'fk_messages_users')
            ->on('users')
            ->references('id')
            ->onDelete('cascade');

            $table->unsignedBigInteger('partyId');
            $table->foreign('partyId', 'fk_messages_parties')
            ->on('parties')
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

        Schema::dropIfExists('messages');

    }
    
}

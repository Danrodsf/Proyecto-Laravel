<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartiesTable extends Migration {
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        
        Schema::create('parties', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->boolean('owner');
            $table->timestamps();

             //Foreign Keys
            $table->unsignedBigInteger('gameId');
            $table->foreign('gameId', 'fk_parties_games')
            ->on('games')
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

        Schema::dropIfExists('party');

    }

}

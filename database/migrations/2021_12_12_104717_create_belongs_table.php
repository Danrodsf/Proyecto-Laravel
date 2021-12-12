<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelongsTable extends Migration {
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::create('belongs', function (Blueprint $table) {

            $table->id();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            //Foreign Keys
            $table->unsignedBigInteger('userId');
            $table->foreign('userId', 'fk_belongs_users')
            ->on('users')
            ->references('id')
            ->onDelete('cascade');

            $table->unsignedBigInteger('partyId');
            $table->foreign('partyId', 'fk_belongs_parties')
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

        Schema::dropIfExists('belongs');

    }

}

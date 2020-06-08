<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            // $table->string('id_pagarme')/*->unique()*/;
            $table->string('card_number');
            $table->string('card_expiration_date');
            $table->string('card_holder_name');
            $table->string('card_cvv');
            // $table->string('street_number');
            // $table->string('neighborhood');
            // $table->string('cep');
            // $table->string('city');
            // $table->string('state');
            // $table->biginteger('user_id')->unsigned()->unique();
            $table->timestamps();
        });
        // Schema::table('cards', function (Blueprint $table)
        // {
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
}

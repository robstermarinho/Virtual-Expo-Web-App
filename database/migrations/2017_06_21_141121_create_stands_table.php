<?php

use App\Stand;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stands', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned()->index();
            $table->string('name');
            $table->string('description');
            $table->string('price');
            $table->string('dimensions');
            $table->string('photo_url');
            $table->string('status')->default(Stand::UNAVAILABLE_STAND);
            $table->timestamps();

            // Fofeign keys
            $table->foreign('event_id')->references('id')->on('events');
            // A composite unique index
            $table->unique(['id', 'event_id'], 'ck_stand_event');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stands');
    }
}

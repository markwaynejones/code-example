<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceBreakpointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_breakpoints', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('price_id');
            $table->integer('range_from');
            $table->integer('range_to');
            $table->decimal('price', 5, 2);

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
        Schema::drop('price_breakpoints');
    }
}

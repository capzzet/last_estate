<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('property_type');
            $table->string('deal_type');
            $table->string('city');
            $table->string('address');
            $table->integer('rooms');
            $table->integer('price_from');
            $table->integer('price_to');
            $table->integer('floor_from');
            $table->integer('floor_to');
            $table->integer('total_floors');
            $table->integer('area_from');
            $table->integer('area_to');
            $table->string('balcony');
            $table->string('bathroom');
            $table->string('view');
            $table->string('renovation');
            $table->string('house_type');
            $table->text('description');
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
        Schema::dropIfExists('advertisements');
    }
}

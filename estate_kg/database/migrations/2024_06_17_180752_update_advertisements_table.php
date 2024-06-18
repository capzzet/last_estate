<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAdvertisementsTable extends Migration
{
    public function up()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->dropColumn(['price_from', 'price_to', 'floor_from', 'floor_to', 'area_from', 'area_to']);
            $table->integer('price')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('area')->nullable();
        });
    }

    public function down()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->dropColumn(['price', 'floor', 'area']);
            $table->integer('price_from')->nullable();
            $table->integer('price_to')->nullable();
            $table->integer('floor_from')->nullable();
            $table->integer('floor_to')->nullable();
            $table->integer('area_from')->nullable();
            $table->integer('area_to')->nullable();
        });
    }
}

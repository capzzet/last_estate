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
            $table->string('property_type'); // Тип недвижимости
            $table->string('deal_type'); // Купить/Снять
            $table->string('city'); // Город
            $table->string('address'); // Адрес
            $table->integer('rooms'); // Комнатность
            $table->integer('price_from'); // Цена (от)
            $table->integer('price_to'); // Цена (до)
            $table->integer('floor_from'); // Этаж (от)
            $table->integer('floor_to'); // Этаж (до)
            $table->integer('total_floors'); // Этажей в доме
            $table->integer('area_from'); // Площадь (от)
            $table->integer('area_to'); // Площадь (до)
            $table->string('balcony'); // Балкон
            $table->string('bathroom'); // Санузел
            $table->string('view'); // Вид из окон
            $table->string('renovation'); // Ремонт
            $table->string('house_type'); // Тип дома
            $table->text('description'); // Описание
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

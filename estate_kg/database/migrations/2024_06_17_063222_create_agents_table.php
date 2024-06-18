<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->string('phone')->nullable(); // Добавляем поле для номера телефона
            $table->string('telegram_link')->nullable(); // Добавляем поле для ссылки на Telegram
            $table->string('whatsapp_link')->nullable(); // Добавляем поле для ссылки на WhatsApp
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agents');
    }
}

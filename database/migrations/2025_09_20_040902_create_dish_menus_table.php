<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dish_menus', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('dish_id');
            $table->foreign('dish_id')
                ->references('id')
                ->on('dishes')
                ->onDelete('restrict');

            $table->unsignedBigInteger('menu_id');
            $table->foreign('menu_id')
                ->references('id')
                ->on('menus')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dish_menus');
    }
};

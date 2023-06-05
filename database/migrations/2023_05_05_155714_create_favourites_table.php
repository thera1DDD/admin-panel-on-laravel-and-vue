<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courses_id')
                ->nullable()
                ->index()
                ->constrained('courses')
                ->onDelete('cascade');;
            $table->foreignId('users_id')
                ->nullable()
                ->index()
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('slug')->nullable();
            $table->integer('sort')->default(500);
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
        Schema::dropIfExists('favourites');
    }
}

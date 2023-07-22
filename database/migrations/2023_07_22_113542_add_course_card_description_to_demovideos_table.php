<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseCardDescriptionToDemovideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('demovideos', function (Blueprint $table) {
            $table->text('course_card_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('demovideos', function (Blueprint $table) {
            $table->dropColumn('course_card_description')->nullable();
        });
    }
}

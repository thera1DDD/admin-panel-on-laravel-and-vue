<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTestProgressToStat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stats', function (Blueprint $table) {
            $table->foreignId('passed_tests_id')
                ->nullable()
                ->index()
                ->constrained('tests')
                ->onDelete('cascade');
            $table->foreignId('passed_questions_id')
                ->nullable()
                ->index()
                ->constrained('questions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stats', function (Blueprint $table) {
            $table->dropForeign('stats_passed_tests_id_foreign');
            $table->dropColumn('passed_tests_id');
            $table->dropForeign('stats_passed_questions_id_foreign');
            $table->dropColumn('passed_questions_id');


        });
    }
}

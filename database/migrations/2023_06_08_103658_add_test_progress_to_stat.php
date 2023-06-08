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
            $table->foreignId('tests_id')
                ->nullable()
                ->index()
                ->constrained('tests')
                ->onDelete('cascade');
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
            $table->foreignId('passed_answers_id')
                ->nullable()
                ->index()
                ->constrained('answers')
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
            Schema::dropColumns('stats',['tests_id','passed_tests_id','passed_questions_id','passed_answers_id',]);
        });
    }
}

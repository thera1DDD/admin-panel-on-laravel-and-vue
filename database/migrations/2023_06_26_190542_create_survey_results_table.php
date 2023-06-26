<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survey_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->index()->constrained('users');
            $table->foreignId('survey_answers_id')->nullable()->index()->constrained('survey_answers');
            $table->foreignId('survey_questions_id')->nullable()->index()->constrained('survey_questions');
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
        Schema::dropIfExists('survey_results');
    }
}

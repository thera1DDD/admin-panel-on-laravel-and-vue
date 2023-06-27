<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tests_id')->nullable()->index()->constrained('tests')->onDelete('cascade');
            $table->foreignId('users_id')->nullable()->index()->constrained('users')->onDelete('cascade');
            $table->string('tests_type')->nullable();
            $table->string('questions_total')->nullable();
            $table->string('questions_correct')->nullable();
            $table->boolean('is_passed')->nullable();
            $table->string('passing_time')->nullable();
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
        Schema::dropIfExists('tests_results');
    }
}

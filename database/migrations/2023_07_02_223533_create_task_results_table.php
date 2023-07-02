<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tasks_id')->nullable()->index()->constrained('tasks')->onDelete('cascade');
            $table->foreignId('users_id')->nullable()->index()->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('tasks_results');
    }
}

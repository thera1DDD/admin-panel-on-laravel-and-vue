<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('passed_courses_id')
                ->nullable()
                ->index()
                ->constrained('courses')
                ->onDelete('cascade');
            $table->foreignId('passed_modules_id')
                ->nullable()
                ->index()
                ->constrained('modules')
                ->onDelete('cascade');
            $table->foreignId('passed_videos_id')
                ->nullable()
                ->index()
                ->constrained('videos')
                ->onDelete('cascade');
            $table->foreignId('users_id')
                ->nullable()
                ->index()
                ->constrained('users')
                ->onDelete('cascade');
            $table->datetime('passed_course_date')->nullable();
            $table->datetime('passed_module_date')->nullable();
            $table->datetime('passed_video_date')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('stats');
    }
}

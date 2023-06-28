<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnLanguageInTranslate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('translates', function (Blueprint $table) {
//            $table->unsignedBigInteger('languages_id');
            $table->dropColumn('language');
            $table->foreignId('languages_id')->nullable()->index()->constrained('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('translates', function (Blueprint $table) {
            $table->string('language');
            $table->dropConstrainedForeignId('languages_id');
//            $table->dropColumn('languages_id');
        });
    }
}

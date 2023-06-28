<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnLanguageInTableSwithLangs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('switch_langs', function (Blueprint $table) {
//            $table->unsignedBigInteger('languages_id');
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
        Schema::table('switch_langs', function (Blueprint $table) {
            $table->dropConstrainedForeignId('languages_id');
//            $table->dropColumn('languages_id');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ChangePhotoDefaultValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $newDefaultValue = getUrl();

        Schema::table('users', function (Blueprint $table) use ($newDefaultValue) {
            $table->string('photo')->default($newDefaultValue)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo')->default('profile.jpg')->change();
        });
    }
}

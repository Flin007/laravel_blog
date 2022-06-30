<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsForImagesToPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('main_image')->nullable();
            $table->string('preview_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Отдельно так как SQLITE не может дропнуть сразу 2
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('main_image');
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('preview_image');
        });
    }
}

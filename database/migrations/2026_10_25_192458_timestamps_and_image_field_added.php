<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TimestampsAndImageFieldAdded extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('castles', function (Blueprint $table) {
            $table->string("image");
            $table->timestamps();
        });

        Schema::table('dictionary', function (Blueprint $table) {
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
        Schema::table('castles', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropTimestamps();
        });

        Schema::table('dictionary', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}

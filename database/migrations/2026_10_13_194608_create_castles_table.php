<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCastlesTable extends Migration
{
    /**
     * The database connection that should be used by the migration.
     *
     * @var string
     */
    protected $connection = 'pg_castles';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('castles', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->string("type");
            $table->text("full_description");
        });

        Schema::create('dictionary', function (Blueprint $table) {
            $table->id();
            $table->string("term");
            $table->string("definition");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('castles');
        Schema::dropIfExists('dictionary');
    }
}

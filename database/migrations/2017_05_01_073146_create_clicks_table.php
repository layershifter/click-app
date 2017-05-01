<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('click', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');

            $table->string('ua', 512)->index()->nullable();
            $table->string('ip', 15)->index();
            $table->string('ref', 512)->index()->nullable();
            $table->string('param1')->index();
            $table->string('param2');
            $table->unsignedInteger('error')->default(0);
            $table->unsignedTinyInteger('bad_domain')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('click');
    }
}

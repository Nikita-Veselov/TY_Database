<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TC', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('klemm')->nullable();
            $table->string('number');
            $table->string('invert')->nullable();;
            $table->string('oper');
            $table->string('DP');
            $table->string('cp-code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TC');
    }
}

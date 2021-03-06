<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('type');
            $table->string('date');
            $table->string('controlledPoint');
            $table->string('device');
            $table->string('UTY');
            $table->string('UTC');
            $table->string('UTP');
            $table->string('worker1');
            $table->string('worker2')->nullable();
            $table->string('worker3');
            $table->string('worker4');
            $table->string('conclusion');
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
        Schema::dropIfExists('records');
    }
}

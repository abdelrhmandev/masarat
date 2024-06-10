<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormExtraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_extra', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->signed()->nullable()->default(0);
            $table->string('key', 100)->nullable()->default('');
            $table->string('value', 100)->nullable()->default('');
            $table->string('label', 100)->nullable()->default('');
            $table->integer('int_id')->nullable();
            $table->integer('pen_id')->nullable();
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
        Schema::dropIfExists('form_extra');
    }
}

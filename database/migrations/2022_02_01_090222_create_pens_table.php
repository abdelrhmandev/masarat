<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('personal_id');
            $table->string('name', 250)->nullable()->default('none');
            $table->integer('mobile');
            $table->integer('confirmation_code');
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
        Schema::dropIfExists('pens');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pen_id')->nullable()->default(0);
            $table->integer('int_id')->unsigned()->nullable()->default(0);
            $table->integer('family_count')->unsigned()->nullable()->default(0);
            $table->integer('able_to_work')->unsigned()->nullable()->default(0);
            $table->double('need', 15, 2)->nullable()->default(0.0);
            $table->double('development', 15, 2)->nullable()->default(0.0);
            $table->integer('status')->unsigned()->nullable()->default(1);
            $table->integer('role_id')->unsigned()->nullable()->default(1);
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
        Schema::dropIfExists('forms');
    }
}

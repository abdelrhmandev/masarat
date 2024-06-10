<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_submission', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->unsigned()->nullable()->default(0);
            $table->bigInteger('pen_id')->nullable()->default(0);
            $table->integer('is_confirmed')->unsigned()->nullable()->default(0);
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
        Schema::dropIfExists('form_submission');
    }
}

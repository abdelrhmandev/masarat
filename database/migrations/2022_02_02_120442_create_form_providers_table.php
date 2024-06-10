<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_providers', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->unsigned()->nullable()->default(0);
            $table->integer('provider_id')->unsigned()->nullable()->default(0);
            $table->string('extra_name',250);
            $table->string('extra_phone',12);
            $table->string('extra_email',250);
            $table->text('extra_notes');
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
        Schema::dropIfExists('form_providers');
    }
}

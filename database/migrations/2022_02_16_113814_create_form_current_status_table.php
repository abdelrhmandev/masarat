<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormCurrentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_current_status', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id')->unsigned()->nullable(false)->default(0);
            $table->integer('status_id')->unsigned()->nullable(false)->default(0);
            $table->string('reason', 100)->nullable()->default('No Data');
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
        Schema::dropIfExists('form_current_status');
    }
}

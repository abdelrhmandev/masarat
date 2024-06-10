<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReactivatedUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reactivated_urls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pen_id');
            $table->timestamp('reactivated_from');
            $table->timestamp('reactivated_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reactivated_urls');
    }
}

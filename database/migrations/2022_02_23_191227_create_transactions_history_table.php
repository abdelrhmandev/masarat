<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_history', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable()->default(0);
            $table->integer('form_id')->unsigned()->nullable()->default(0);
            $table->integer('status_id')->unsigned()->nullable()->default(12);
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
        Schema::dropIfExists('transactions_history');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsParentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms_parent', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pen_id')->nullable(false)->default(0);
            $table->string('breadwinner_gender', 6)->nullable();
            $table->string('breadwinner_social_status', 6)->nullable();
            $table->integer('family_count')->unsigned()->nullable()->default(0);
            $table->string('disabled', 7)->default('لا يوجد');
            $table->integer('able_to_work')->unsigned()->nullable()->default(0);
            $table->double('need', 15, 8)->nullable()->default(0.0);
            $table->double('development', 15, 8)->nullable()->default(0.0);
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
        Schema::dropIfExists('forms_parent');
    }
}

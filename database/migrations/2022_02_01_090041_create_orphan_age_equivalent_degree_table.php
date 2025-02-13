<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrphanAgeEquivalentDegreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orphan_age_equivalent_degree', function (Blueprint $table) {
            $table->id();
            $table->string('value', 100);
            $table->integer('form_id');
            $table->foreignId('stage_id')->constrained('stages')->onDelete('cascade');
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
        Schema::dropIfExists('orphan_age_equivalent_degree');
    }
}

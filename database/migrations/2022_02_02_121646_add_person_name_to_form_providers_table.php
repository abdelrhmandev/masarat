<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPersonNameToFormProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_providers', function (Blueprint $table) {
            $table->string('extra_person_name', 250)->after('extra_name')->nullable()->default('none');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_providers', function (Blueprint $table) {
            $table->dropColumn('extra_person_name');
        });
    }
}

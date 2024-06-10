<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropExtraColumnsFromFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->integer('forms_parent_id')->after('id')->unsigned()->nullable(false)->default(0);
            $table->dropColumn('pen_id');
            $table->dropColumn('family_count');
            $table->dropColumn('able_to_work');
            $table->dropColumn('need');
            $table->dropColumn('development');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->dropColumn('forms_parent_id');
            $table->bigInteger('pen_id')->nullable(false)->default(0);
            $table->integer('family_count')->unsigned()->nullable()->default(0);
            $table->integer('able_to_work')->unsigned()->nullable()->default(0);
            $table->double('need', 15, 8)->nullable()->default(0.0);
            $table->double('development', 15, 8)->nullable()->default(0.0);
        });
    }
}

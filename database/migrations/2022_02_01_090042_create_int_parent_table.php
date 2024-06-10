<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntParentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('int_parent', function (Blueprint $table) {
            $table->id();
            $table->string('name_en', 250)->nullable();
            $table->string('name_ar', 250)->nullable();
            $table->timestamps();
        });

        $insertions             = [
            ['name_en' => 'Housing interventions', 'name_ar' => 'المسار السكني', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_en' => 'Direct Support interventions', 'name_ar' => ' مسار الدعم المباشر', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_en' => 'Health interventions', 'name_ar' => 'مسار الدعم الصحي', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_en' => 'Employment and Entrepreneurship interventions', 'name_ar' => ' مسار التوظيف وريادة الأعمال', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_en' => 'Logistical Support Path', 'name_ar' => ' مسار الدعم اللوجستي', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_en' => 'Orphan Support Path', 'name_ar' => 'مسار دعم اليتيم', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],        
        ];


        DB::table('int_parent')->insert($insertions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('int_parent');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InputRelatedIntsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('input_related_ints')->insert([
            ['int_id' => 1] // ترميم و صيانة
            , ['int_id' => 2] // دعم ايجار
            , ['int_id' => 4] // repair a car
            , ['int_id' => 7] // سداد كلي
            , ['int_id' => 8] // تفريج كرب
            , ['int_id' => 11] // تجهيزات
            , ['int_id' => 12] // تأهيل عمليات
            , ['int_id' => 13] // تأهيل صحي
            , ['int_id' => 14] // مصروفات سفر
            , ['int_id' => 15] // تأمين الفرص الوظيفية
            , ['int_id' => 16] // تكاليف المشاريع
            , ['int_id' => 17] // تكاليف البرامج التأهيلية
            , ['int_id' => 18] //  برامج التأهيل
            , ['int_id' => 23] // سداد جزئي
        ]);
    }
}

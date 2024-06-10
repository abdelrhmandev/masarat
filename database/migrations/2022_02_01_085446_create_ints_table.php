<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ints', function (Blueprint $table) {
            $table->id();
            $table->string('name_short', 250)->nullable();
            $table->string('name_ar', 250)->nullable();
            $table->integer('parent')->unsigned()->nullable();
            $table->text('image')->nullable();
            $table->boolean('active', 1)->default(1);
            $table->timestamps();
        });

        $insertions             = [
            // التدخلات في المجال السكني parent = 1
            ['name_short' => 'ترميم وصيانة', 'name_ar' => 'ترميم و صيانة', 'parent' => '1', 'image' => 'img/housing_interventions/house_searching.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'دعم إيجار', 'name_ar' => 'دعم ايجار', 'parent' => '1', 'image' => 'img/housing_interventions/buy_house.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'إستبدال', 'name_ar' => 'استبدال', 'parent' => '1', 'image' => 'img/housing_interventions/for_sale.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],

            // التدخلات في مجال الدعم المباشر parent = 2
            ['name_short' => 'صيانة مركبة', 'name_ar' => 'صيانة مركبة', 'parent' => '2', 'image' => 'img/direct_support_interventions/towing.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'تأمين وسيلة مواصلات', 'name_ar' => 'تأمين وسيلة مواصلات', 'parent' => '2', 'image' => 'img/direct_support_interventions/order_ride.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'تأمين مركبة', 'name_ar' => 'تأمين مركبة', 'parent' => '2', 'image' => 'img/direct_support_interventions/vehicle_sale.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'سداد كلي', 'name_ar' => 'سداد كلي', 'parent' => '2', 'image' => 'img/direct_support_interventions/online_payments.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'تفريج كرب', 'name_ar' => 'تفريج كرب', 'parent' => '2', 'image' => 'img/direct_support_interventions/online_payments.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'دعم التجهيزات', 'name_ar' => 'دعم التجهيزات', 'parent' => '2', 'image' => 'img/direct_support_interventions/shopping_app.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '0'],
            ['name_short' => 'الإعانة الشهرية', 'name_ar' => 'الإعانة الشهرية', 'parent' => '2', 'image' => 'img/direct_support_interventions/online_calendar.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],

            // التدخلات في مجال الدعم الصحي parent = 3
            ['name_short' => 'تامين علاج', 'name_ar' => 'تأمين علاج', 'parent' => '3', 'image' => 'img/medical_interventions/medical_payment.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'تجهيزات طبية', 'name_ar' => 'تجهيزات طبية', 'parent' => '3', 'image' => 'img/medical_interventions/medical_equipment.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'تأمين عمليات', 'name_ar' => 'تأمين عمليات', 'parent' => '3', 'image' => 'img/medical_interventions/medical_operations.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'تأهيل صحي', 'name_ar' => 'تأهيل صحي', 'parent' => '3', 'image' => 'img/medical_interventions/medical_rehabilitation.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'مصروفات سفر', 'name_ar' => 'مصروفات سفر', 'parent' => '3', 'image' => 'img/medical_interventions/medical_health_travel_expenses_insurance.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],

            // التدخلات في مجال توظيف القدرات وريادة الأعمال parent = 4
            ['name_short' => 'فرص وظيفية', 'name_ar' => 'فرص وظيفية', 'parent' => '4', 'image' => 'img/job_interventions/interior_design.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'المشاريع', 'name_ar' => 'المشاريع', 'parent' => '4', 'image' => 'img/job_interventions/instant_analysis.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],
            ['name_short' => 'برامج التأهيل', 'name_ar' => 'برامج التأهيل', 'parent' => '4', 'image' => 'img/job_interventions/researching.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '0'],

            // التدخلات في مجال الدعم اللوجستي parent = 5
            ['name_short' => 'Social Protection for Beneficiaries', 'name_ar' => 'الحماية الإجتماعية', 'parent' => '5', 'image' => 'img/logistics_interventions/security.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '0'],
            ['name_short' => 'Deregulation Expenses', 'name_ar' => 'نفقات رفع القيود', 'parent' => '5', 'image' => 'img/logistics_interventions/credit_card.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '0'],
            ['name_short' => 'Contribute to Lifting Restrictions', 'name_ar' => 'الإسهام في رفع القيود', 'parent' => '5', 'image' => 'img/logistics_interventions/predictive_analytics.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '0'],
            ['name_short' => 'Obtaining Identification Papers', 'name_ar' => 'الأوراق الثبوتية', 'parent' => '5', 'image' => 'img/logistics_interventions/detailed_information.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '0'],
            ['name_short' => 'سداد جزئي', 'name_ar' => 'سداد جزئي', 'parent' => '2', 'image' => 'img/direct_support_interventions/online_payments.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],

            // تدخل الأيتام
            ['name_short' => 'تدخل الأيتام', 'name_ar' => 'تدخل الأيتام', 'parent' => '6', 'image' => 'img/orphan_interventions/orphan_intervention.svg', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'active' => '1'],



        ];

        DB::table('ints')->insert($insertions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ints');
    }
}

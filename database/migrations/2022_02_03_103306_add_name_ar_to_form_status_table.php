<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameArToFormStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_status', function (Blueprint $table) {
            $table->renameColumn('name', 'name_en');
            $table->string('name_ar', 100)->after('id')->nullable()->default('text');
            $table->string('comment', 250)->nullable()->default('');
        });

        $insertions             = [
            ['name_ar' => 'جديدة', 'name_en' => 'placed', 'comment' => '', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'تم ارسال البيانات', 'name_en' => 'submitted', 'comment' => 'تم رفع البيانات المتبقية من قبل المستفيد', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'معتمدة', 'name_en' => 'confirmed', 'comment' => 'تم عمل الفرز والتحويل', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'محولة للشراكات', 'name_en' => 'transfered to partners', 'comment' => 'تحويل التدخل إلى حساب إدارة الشراكات', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'تحت الاجراء', 'name_en' => 'partners waiting', 'comment' => 'بإنتظار إدارة الشراكات لجلب الدعم للتدخل', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'مدعومة', 'name_en' => 'Attached to provider', 'comment' => 'تم توفير الدعم للتدخل من قبل  إدارة الشراكات', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'للتنفيذ', 'name_en' => 'Execution', 'comment' => 'تم تحويل التدخل إلى الإدارة التنفيذية بانتظار الموافقة بتمرير التدخل إلى الإدارة التشغيلية ', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'منفذة', 'name_en' => 'Executed', 'comment' => 'تم تنفيذ التدخل من قبل الإدارة التشغيلية', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'مغلقة', 'name_en' => 'Closed', 'comment' => 'تم إغلاق التدخل من قبل الإدارة التشغيلية', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'معلقة', 'name_en' => 'Hanged', 'comment' => 'تم تعليق التدخل من قبل الإدارة التشغيلية', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'دعم مرفوض', 'name_en' => 'rejected support', 'comment' => 'الإدارة التنموية رفضت الدعم الموفر من قبل إدارة الشراكات', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'مرتجع', 'name_en' => 'Returned', 'comment' => 'تم إرجاع التدخل من قبل الإدارة التنفيذية', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'دعم مقبول', 'name_en' => 'approved support', 'comment' => 'الإدارة التنموية قبلت الدعم الموفر من قبل إدارة الشراكات', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'تمت الموافقه من الاداره', 'name_en' => 'approved Executive Director', 'comment' => 'تمت الموافقة من قبل الإدارة التنفيذية لتحويل التدخل إلى الإدارة التنفيذية للبدء في العمل', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'تم تاكيد الدعم من الاداره', 'name_en' => 'approved support Executive Director', 'comment' => 'تمت الموافقة من قبل الإدارة التنفيذية لتحويل التدخل إلى الإدارة التنفيذية للبدء في العمل', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'تم الرفض من الاداره', 'name_en' => 'rejected by Executive Director', 'comment' => 'تم رفض التدخل من قبل الإدارة التنفيذية وسيتم تحويله إلى الإدارة التنموية لعمل اللازم', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['name_ar' => 'تم رفض الدعم من الاداره', 'name_en' => 'reject support Executive Director', 'comment' => 'تم رفض التدخل من قبل الإدارة التنفيذية وسيتم تحويله إلى إداراة الشراكات لعمل اللازم', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ];
        DB::table('form_status')->truncate();
        DB::table('form_status')->insert($insertions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_status', function (Blueprint $table) {
            $table->dropColumn('name_ar');
            $table->renameColumn('name_en', 'name');
            DB::table('form_status')->truncate();
        });
    }
}

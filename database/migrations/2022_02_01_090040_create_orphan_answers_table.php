    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrphanAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orphan_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('objective_id')->constrained('objectives')->onDelete('cascade');
            $table->integer('form_id');
            $table->text('notes')->nullable();
            $table->enum('completed_case', ['completed', 'notcompleted'])->nullable()->comment('completed : مكتمل , notcompleted : غير مكتمل');
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
        Schema::dropIfExists('orphan_answers');
    }
}

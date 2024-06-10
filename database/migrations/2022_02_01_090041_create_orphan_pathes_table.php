    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrphanPathesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orphan_pathes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('path_id')->constrained('pathes')->onDelete('cascade');
            $table->integer('form_id');
            $table->enum('path_category', ['general', 'advanced'])->comment('general : عام , advanced : متقدم');
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
        Schema::dropIfExists('orphan_pathes');
    }
}

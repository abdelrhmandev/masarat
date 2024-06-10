    <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objectives', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('path_id')->constrained('pathes')->onDelete('cascade');            
            $table->foreignId('form_id')->nullable()->constrained('orphans')->onDelete('cascade');  
            $table->boolean('active', 1)->default(1);          
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
        Schema::dropIfExists('objectives');
    }
}

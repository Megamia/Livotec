<?php namespace Betod\Livotec\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateBetodLivotecFilter4 extends Migration
{
    public function up()
    {
        Schema::table('betod_livotec_filter', function($table)
        {
            $table->string('type', 10)->nullable(false)->unsigned(false)->default(null)->comment(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('betod_livotec_filter', function($table)
        {
            $table->smallInteger('type')->nullable(false)->unsigned(false)->default(null)->comment(null)->change();
        });
    }
}

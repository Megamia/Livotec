<?php namespace Betod\Livotec\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateBetodLivotecFilter3 extends Migration
{
    public function up()
    {
        Schema::table('betod_livotec_filter', function($table)
        {
            $table->smallInteger('type');
        });
    }
    
    public function down()
    {
        Schema::table('betod_livotec_filter', function($table)
        {
            $table->dropColumn('type');
        });
    }
}

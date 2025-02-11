<?php namespace Betod\Livotec\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateBetodLivotecFilter2 extends Migration
{
    public function up()
    {
        Schema::table('betod_livotec_filter', function($table)
        {
            $table->string('type')->nullable();
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

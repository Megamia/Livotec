<?php namespace Betod\Livotec\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateBetodLivotecFilter6 extends Migration
{
    public function up()
    {
        Schema::table('betod_livotec_filter', function($table)
        {
            $table->string('type', 255)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('betod_livotec_filter', function($table)
        {
            $table->string('type', 255)->nullable(false)->change();
        });
    }
}

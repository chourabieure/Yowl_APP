<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('from');  
            $table->unsignedBigInteger('to'); 
            $table->string('status');             
            $table->date('since');

            $table->foreign('from')
                ->references('id')
                ->on('users')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');

            $table->foreign('to')
                ->references('id')
                ->on('users')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relations');
        Schema::table('relations', function (Blueprint $table) {
            $table->dropForeign(['from']);
            $table->dropColumn('from');
        });
        Schema::table('relations', function (Blueprint $table) {
            $table->dropForeign(['to']);
            $table->dropColumn('to');
        });
    }
}

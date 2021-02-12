<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            $table->string('url');
            $table->string('description');
            $table->unsignedBigInteger('id_owner');
            $table->integer('likes');
            $table->foreign('id_owner')
                ->references('id')
                ->on('users')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');

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
        Schema::dropIfExists('posts');
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['id_owner']);
            $table->dropColumn('id_owner');
        });
    }
}

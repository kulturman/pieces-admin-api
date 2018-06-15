<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentParentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_parent', function (Blueprint $table) {
            $table->integer('parent_id')->unsigned();
            $table->integer('document_id')->unsigned();
            
            $table->foreign('parent_id')->on('documents')->references('id');
            $table->foreign('document_id')->on('documents')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_parent', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['document_id']);
        });
        
        Schema::drop('document_parent');
    }
}

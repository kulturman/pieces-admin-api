<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_location', function (Blueprint $table) {
            $table->integer('document_id')->unsigned();
            $table->integer('location_id')->unsigned();
            
            $table->foreign('document_id')->on('documents')->references('id');
            $table->foreign('location_id')->on('locations')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('document_location', function (Blueprint $table) {
            $table->dropForeign(['document_id']);
            $table->dropForeign(['location_id']);
        });
    }
}

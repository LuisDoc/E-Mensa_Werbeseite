<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWunschgerichtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wunschgericht', function (Blueprint $table) {
            $table->id();
            $table->string('gerichtname');
            $table->string('beschreibung');
            $table->date('created_at');
            $table->string('ersteller_email');
            $table->foreign('ersteller_email')->references('email')->on('ersteller')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wunschgericht');
    }
}

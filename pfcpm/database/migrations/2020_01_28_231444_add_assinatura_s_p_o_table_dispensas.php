<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAssinaturaSPOTableDispensas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispensas', function (Blueprint $table) {
            $table->string('assinaturaSPO');
            $table->string('dataSPO');
            $table->string('assinaturaCMD');
            $table->string('optCMD');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dispensas', function (Blueprint $table) {
            //
        });
    }
}

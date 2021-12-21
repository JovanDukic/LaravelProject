<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userTests', function (Blueprint $table) {
            $table->renameColumn('user_id', 'userID');
            $table->renameColumn('covid_test_id', 'covidTestID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userTests', function (Blueprint $table) {
            $table->renameColumn('userID', 'user_id');
            $table->renameColumn('covidTestID', 'covid_test_id');
        });
    }
}

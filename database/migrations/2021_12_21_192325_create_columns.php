<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userTests', function (Blueprint $table) {
            $table->enum('ambulance', ['Ambulance_1', 'Ambulance_2', 'Ambulance_3', 'Ambulance_4', 'Ambulance_5']);
            $table->enum('result', ['positive', 'negative']);
            $table->foreignId('user_id');
            $table->foreignId('covid_test_id');
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
            $table->dropColumn(['ambulance', 'result', 'user_id', 'covid_test_id']);
        });
    }
}

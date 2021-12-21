<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tests', function (Blueprint $table) {
            $table->id();
            $table->string('ambulance');
            $table->string('result');
            $table->timestamps();
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
        Schema::dropIfExists('user_tests');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id('id');
            $table->string('month');
            $table->text('year')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->text('details')->nullable();
            $table->date('date')->nullable()->default(date("Y-m-d"));
            $table->text('type')->nullable()->default('Base pay');

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->ondelete('cascade');

            $table->unique(['employee_id', 'month']);

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
        Schema::dropIfExists('salaries');
    }
}

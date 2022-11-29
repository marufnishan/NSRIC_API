<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devision_units', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('devision_id')->unsigned();
            $table->string('title')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->foreign('devision_id')->references('id')->on('devisions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devision_units');
    }
};

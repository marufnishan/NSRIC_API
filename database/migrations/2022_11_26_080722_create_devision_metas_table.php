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
        Schema::create('devision_metas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('meta_id')->unsigned();
            $table->string('meta_key',50)->nullable();
            $table->string('meta_value')->nullable();
            $table->timestamps();
            $table->foreign('meta_id')->references('id')->on('devisions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devision_metas');
    }
};

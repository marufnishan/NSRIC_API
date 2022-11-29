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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('email',100)->unique();
            $table->string('phone',100)->unique()->default(null);
            $table->string('photo')->nullable();
            $table->enum('gender',['Male','Female','None'])->default('None');           
            $table->string('religion',100)->nullable();
            $table->string('country',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('state',100)->nullable();
            $table->string('postal_code',100)->nullable();
            $table->string('street_address')->nullable();
            $table->longText('bio_data')->nullable();
            $table->string('date_of_birth',100)->nullable();
            $table->string('user_type',100)->default('user');
            $table->boolean('is_affiliate')->default(false);
            $table->boolean('approval')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

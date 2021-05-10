<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('first_name_ruby');
            $table->string('last_name_ruby');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id');
            $table->string('postal_code', 8);
            $table->tinyInteger('gender');
            $table->date('birthday');
            $table->unsignedBigInteger('pref_id');
            $table->string('city');
            $table->string('block');
            $table->string('building');
            $table->string('phone_number', 15);
            $table->rememberToken();
            $table->softDeletes();
            $table->dateTime('created_at', 0)->useCurrent();
            $table->dateTime('updated_at', 0)->useCurrent();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('no action');
            $table->foreign('pref_id')->references('id')->on('prefs')->onDelete('no action');
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
}

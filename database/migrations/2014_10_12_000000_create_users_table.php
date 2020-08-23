<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /*
    Field             | Type             | Null | Key | Default | Extra          |
    +-------------------+------------------+------+-----+---------+----------------+
    | id                | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
    | name              | varchar(255)     | NO   |     | NULL    |                |
    | email             | varchar(255)     | NO   | UNI | NULL    |                |
    | email_verified_at | timestamp        | YES  |     | NULL    |                |
    | password          | varchar(255)     | NO   |     | NULL    |                |
    | remember_token    | varchar(100)     | YES  |     | NULL    |                |
    | created_at        | timestamp        | YES  |     | NULL    |                |
    | updated_at        | timestamp        | YES  |     | NULL    |  
    */

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

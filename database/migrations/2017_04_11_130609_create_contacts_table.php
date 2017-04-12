<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name')->length(25);
            $table->string('email')->nullable()->length(128)->default('undefined');
            $table->integer('phone')->nullable()->length(15)->unsigned();
            $table->string('address')->nullable()->length(50)->default('undefined');
            $table->string('organization')->nullable();
            $table->boolean('is_friend')->default(false);
            $table->date('birthday')->timestamp()->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('email',200);
            $table->string('mobile',11);
            $table->string('title',100);
            $table->string('enquiry',200);
            $table->dateTime('enquiry_date');
            $table->text('reply')->nullable();
            $table->dateTime('reply_date')->nullable();
            $table->boolean('sms')->default(0);
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
        Schema::dropIfExists('enquiries');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('assigned_id')->nullable();
            $table->string('name');
            $table->string('mobile');
            $table->string('subject');
            $table->string('address');
            $table->bigInteger('quantity')->default(0);
            $table->bigInteger('amount')->default(0);
            $table->enum('status',['Pending','Assigned','Processing','Confirm','Completed']);
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
        Schema::dropIfExists('services');
    }
}

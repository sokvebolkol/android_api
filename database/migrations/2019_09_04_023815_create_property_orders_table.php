<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaction_id')->unsigned()->nullable();
            $table->double('service_fee')->default(1);
            $table->boolean('status')->nullable();
            $table->string('message')->nullable();
            $table->integer('error_code')->unsigned()->nullable();
            $table->enum('is_deleted',[0,1])->default(0);
            $table->unsignedBigInteger('property_post_id')->index()->nullable();
            $table->unsignedBigInteger('user_id')->index()->nullable();
            $table->unsignedBigInteger('gateway_type_id')->index()->nullable();
            $table->timestamps();


             // foreign key
             $table->foreign('property_post_id')->references('id')->on('property_posts');
             $table->foreign('gateway_type_id')->references('id')->on('gateway_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_orders');
    }
}

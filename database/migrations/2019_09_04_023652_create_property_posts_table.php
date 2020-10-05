<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('price',8,2)->unsigned();
            $table->string('property_name')->nullable();
            $table->double('land_width',8,2)->unsigned()->nullable();
            $table->double('land_height',8,2)->unsigned()->nullable();
            $table->double('width',8,2)->unsigned()->nullable();
            $table->double('height',8,2)->unsigned()->nullable();
            $table->string('type_villa')->nullable();
            $table->integer('bathroom_number')->unsigned()->nullable();
            $table->integer('bedroom_number')->unsigned()->nullable();
            $table->enum('status',["For Rent","For Sale"]);
            $table->string('phone_number1');
            $table->string('phone_number2');
            $table->string('duration')->nullable();
            $table->longText('description');
            $table->double('latitude');
            $table->double('longitude');
            $table->enum('is_deleted',[0,1])->default(0);
            $table->integer('post_view')->default(0);
            $table->string('check_status_property')->nullable();
            $table->enum('paid',[0,1])->default(0);
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('property_type_id')->index();
            $table->unsignedBigInteger('district_id')->index();
            $table->timestamps();



            // foreign key
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('property_type_id')->references('id')->on('property_types');
            $table->foreign('district_id')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_posts');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();

            $table->double('price')->nullable();

            $table->double('offer_price')->nullable();

            $table->string('image')->nullable();

            $table->enum('package_type', ['Book', 'Video', 'Book & Video']);

            $table->integer('valid_time')->nullable();

            $table->enum('valid_time_type', ['Day', 'Month', 'Year']);


            $table->longText('description')->nullable();

            $table->enum('status', ['Active', 'Inactive']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}

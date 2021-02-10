<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('slug')->nullable();
            $table->double('price')->nullable();

            $table->double('offer_price')->nullable();
            $table->string('video')->nullable();
            $table->boolean('preview')->default(0);
            $table->boolean('feature')->default(0);
            $table->unsignedInteger('position')->nullable();
            $table->text('image')->nullable();
            $table->string('author')->nullable();
            $table->string('time')->nullable();
            $table->longText('description')->nullable();
            $table->longText('table_of_content')->nullable();
            $table->enum('status', ['Active', 'Inactive']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}

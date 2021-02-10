<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('slug')->nullable();
            $table->double('price')->nullable();

            $table->double('offer_price')->nullable();
            $table->text('book')->nullable();
            $table->unsignedInteger('position')->nullable();
            $table->text('image')->nullable();
            $table->string('author')->nullable();
            $table->string('isbn_no')->nullable();
            $table->string('sku')->nullable();
            $table->string('edition')->nullable();
            $table->string('language')->nullable();
            $table->longText('description')->nullable();
            $table->longText('table_of_content')->nullable();
            $table->enum('status', ['Active', 'Inactive']);
            $table->enum('digital_or_hardcopy', ['DigitalCopy', 'HardCopy', 'Both']);
            $table->unsignedInteger('quantity')->nullable();
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
        Schema::dropIfExists('books');
    }
}

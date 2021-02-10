<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();
            $table->integer('post_author')->unsigned()->nullable();
            $table->longText('post_content')->nullable();
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->string('field_type')->nullable();
            $table->enum('status', ['Active', 'InActive'])->nullable();
            $table->enum('field_position', ['after_title', 'after_content', 'sidebar'])->nullable();
            $table->integer('position')->unsigned()->nullable();
            $table->bigInteger('post_parent')->unsigned()->nullable();
            $table->bigInteger('post_type')->unsigned()->nullable();
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
        Schema::dropIfExists('custom_fields');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGobalPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gobal_posts', function (Blueprint $table) {
            $table->id();
            $table->integer('post_author')->unsigned()->nullable();
            $table->longText('post_content')->nullable();
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['Active', 'InActive'])->nullable();
            $table->integer('position')->unsigned()->nullable();
            $table->bigInteger('post_parent')->unsigned()->nullable();
            $table->string('post_type')->nullable();
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
        Schema::dropIfExists('gobal_posts');
    }
}

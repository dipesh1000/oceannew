<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGobalPostMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gobal_post_metas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('gobal_post_id')->unsigned()->nullable();
            $table->text('key')->nullable();
            $table->longtext('value')->nullable();
            $table->string('post_type')->nullable();
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
        Schema::dropIfExists('gobal_post_metas');
    }
}

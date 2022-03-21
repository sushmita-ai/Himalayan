<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->enum('status',['active','in_active'])->nullable()->default('in_active');
            $table->enum('feature',['yes','no'])->nullable()->default('no');
            $table->unsignedBigInteger('last_updated_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('last_updated_by')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
            $table->softDeletes();
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
        Schema::dropIfExists('sub_categories');
    }
}

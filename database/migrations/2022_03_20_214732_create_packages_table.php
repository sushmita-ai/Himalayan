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
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('category_id')->unsigned()->index()->nullable();
            $table->bigInteger('subcategory_id')->unsigned()->index()->nullable();
            $table->enum('status',['yes','no'])->nullable()->default('no');
            $table->enum('is_featured',['yes','no'])->nullable()->default('no');
            $table->enum('is_trending',['yes','no'])->nullable()->default('no');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onUpdate('cascade')->onDelete('set null');
            $table->string('level')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('trip_duration')->nullable();
            $table->string('max_altitude')->nullable();
            $table->string('price')->nullable();
            $table->string('offer_price')->nullable();
            $table->longText('cost_excludes')->nullable();
            $table->longText('cost_includes')->nullable();
            $table->string('package_type')->nullable();
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
        Schema::dropIfExists('packages');
    }
}

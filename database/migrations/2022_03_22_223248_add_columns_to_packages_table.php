<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->string('general_images')->nullable()->after('image');
            $table->string('banner_images')->nullable()->after('general_images');
            $table->string('location_map')->nullable();
            $table->enum('deal',['yes','no'])->nullable()->default('no')->after('status');
            $table->enum('is_offer',['yes','no'])->nullable()->default('no')->after('deal');

            $table->string('top')->nullable();
            $table->string('special_flags')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages', function (Blueprint $table) {
            //
        });
    }
}

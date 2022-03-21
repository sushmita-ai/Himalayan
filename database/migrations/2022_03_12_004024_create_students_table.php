<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('subject');
            $table->integer('roll');
            $table->string('image')->default('user_default.jpg')->nullable();
            $table->bigInteger('subject_id')->unsigned()->index()->nullable();
            $table->unsignedBigInteger('last_updated_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->enum('status',['active','in_active'])->nullable()->default('in_active');
            $table->enum('visibility',['visible','invisible'])->nullable()->default('invisible');
            $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('subjects')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('last_updated_by')->references('id')->on('subjects')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('students');
    }
}

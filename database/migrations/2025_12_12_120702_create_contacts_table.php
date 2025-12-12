<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable();
            $table->enum('type', ['b2c','b2b'])->default('b2c');
            $table->string('source_type')->nullable();
            $table->unsignedBigInteger('source_id')->nullable();
            $table->timestamps();


            $table->unique(['source_type','source_id']);
        });
    }


    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
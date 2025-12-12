<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
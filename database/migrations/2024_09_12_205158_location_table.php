<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('loc_name');
            $table->string('loc_phone');
            $table->string('loc_email');
            $table->string('loc_address');
            $table->longText('loc_resume');          
            $table->string('loc_status');   
            $table->string('loc_capa');   
            $table->string('slug');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};

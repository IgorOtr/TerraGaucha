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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('promo_title');
            $table->longText('promo_content');
            $table->longText('promo_subcontent');
            $table->longText('promo_restriction');
            $table->string('promo_btn_title');
            $table->string('promo_btn_link');
            $table->string('promo_status');
            $table->string('promo_capa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};

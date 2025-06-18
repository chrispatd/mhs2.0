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
        Schema::create('ms_menu', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama menu, cth: 'Dashboard'
            $table->string('route'); // Nama route dari Laravel, cth: 'dashboard'
            $table->string('icon'); // Nama ikon, cth: 'home'
            $table->integer('order')->default(0); // Urutan menu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_menu');
    }
};

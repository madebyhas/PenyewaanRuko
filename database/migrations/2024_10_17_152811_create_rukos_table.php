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
        Schema::create('rukos', function (Blueprint $table) {
            $table->id('id_ruko');
            $table->string('jenis_ruko');
            $table->integer('luas_ruko', false);
            $table->integer('no_ruko', false);
            $table->integer('harga', false);
            $table->enum('status', ['0', 'tidak tersedia'])->default('0'); // Kolom status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rukos');
    }
};

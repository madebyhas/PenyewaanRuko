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
        Schema::create('penyewas', function (Blueprint $table) {
            $table->id('id_penyewa');
            $table->string('nama_penyewa', 35);
            $table->string('nama_usaha', 100);
            $table->string('alamat', 100);
            $table->string('jenis_kelamin', 35);
            $table->string('telp', 13);
            
            $table->string('username', 25)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewas');
    }
};

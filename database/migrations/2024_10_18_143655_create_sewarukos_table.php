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
        Schema::create('sewarukos', function (Blueprint $table) {
            $table->id('id_sewaruko');
            $table->foreignId('ruko_id')->constrained('rukos', 'id_ruko') // Menentukan tabel dan kolom referensi
            ->onDelete('cascade'); 
            $table->foreignId('penyewa_id')->constrained('penyewas', 'id_penyewa') // Menentukan tabel dan kolom referensi
            ->onDelete('cascade'); 
            $table->float('durasi');
            $table->date('tgl_sewa'); // Kolom tgl_sewa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewarukos');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->foreignId('sewaruko_id')->constrained('sewarukos', 'id_sewaruko')
                ->onDelete('cascade');
            $table->decimal('total', 10, 2)->nullable(); // Kolom biaya
            $table->date('tgl_awal_tagihan')->nullable(); // Kolom tgl_sewa
            $table->date('tgl_akhir_tagihan')->nullable(); // Kolom tgl_sewa
            $table->string('bukti')->nullable(); // Kolom untuk menyimpan path file bukti transfer
            $table->enum('metode', ['BCA', 'Mandiri', 'BRI'])->nullable();
            $table->enum('status', ['0', 'selesei', 'batal'])->nullable(); // Kolom status
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};

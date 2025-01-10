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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nip');
            $table->date('tanggal_pinjam');
            $table->date('selesai_pinjam');
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->foreignId('sopir_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('kegiatan');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};

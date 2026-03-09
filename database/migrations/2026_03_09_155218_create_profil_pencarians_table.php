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
        Schema::create('hasil_pelacakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained('alumni')->onDelete('cascade');
            $table->string('sumber');
            $table->string('nama_kandidat');
            $table->string('afiliasi')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('topik')->nullable();
            $table->integer('skor')->default(0);
            $table->string('status')->default('Perlu Verifikasi');
            $table->text('link_bukti')->nullable();
            $table->text('ringkasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_pelacakan');
    }
};

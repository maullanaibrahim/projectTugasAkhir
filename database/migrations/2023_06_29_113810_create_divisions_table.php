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
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('nama_divisi');
            $table->string('lokasi');
            $table->string('alamat');
            $table->timestamps();
        });

        DB::table('divisions')->insert([
            ['nama_divisi' => 'Procurement', 'lokasi' => 'Griya Center', 'alamat' => 'Jl. Soekarno Hatta No. 236 Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};

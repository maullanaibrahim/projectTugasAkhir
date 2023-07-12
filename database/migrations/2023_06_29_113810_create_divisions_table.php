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
            $table->string('division_name');
            $table->string('location');
            $table->string('address');
            $table->timestamps();
        });

        DB::table('divisions')->insert([
            ['division_name' => 'Information Technology', 'location' => 'Head Office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_name' => 'Asset Management', 'location' => 'Head Office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_name' => 'Operational Reg. A', 'location' => 'Head Office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_name' => 'Operational Reg. B', 'location' => 'Head Office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_name' => 'Operational Reg. C', 'location' => 'Head Office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_name' => 'Operational Reg. D', 'location' => 'Head Office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_name' => 'Operational Area 1', 'location' => 'Head Office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_name' => 'Operational Area 2', 'location' => 'Head Office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_name' => 'Procurement', 'location' => 'Head Office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59'],
            ['division_name' => 'Maulana Center', 'location' => 'Head Office', 'address' => 'Jl. Soreang-Cipatik No. 1, Kutawaringin, Kab. Bandung', 'created_at' => '2023-06-29 11:40:59', 'updated_at' => '2023-06-29 11:40:59']
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

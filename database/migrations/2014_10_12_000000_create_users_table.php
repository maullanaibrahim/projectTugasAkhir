<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('nik')->unique();
            $table->string('password');
            $table->string('position_id');
            $table->string('division_id');
            $table->timestamps();
        });

        DB::table('users')->insert([
            ['first_name'   => 'Administrator', 
             'last_name'    => 'IT', 
             'nik'          => '12345',
             'password'     => Hash::make('password'), 
             'position_id'  => '1', 
             'division_id'  => '1', 
             'created_at'   => '2023-06-29 11:40:59', 
             'updated_at'   => '2023-06-29 11:40:59'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

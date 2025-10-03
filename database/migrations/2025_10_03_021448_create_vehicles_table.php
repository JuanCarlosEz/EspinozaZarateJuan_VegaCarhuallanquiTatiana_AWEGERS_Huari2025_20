<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('placa')->unique();
            $table->string('modelo')->nullable();
            $table->foreignId('driver_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('zona')->nullable(); // zona o distrito
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

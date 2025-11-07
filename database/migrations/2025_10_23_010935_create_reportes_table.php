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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('zona_id')->nullable();
            $table->string('tipo_incidencia');
            $table->text('descripcion')->nullable();
            $table->string('nivel_prioridad')->default('bajo');
            $table->string('referencia')->nullable();
            $table->string('foto')->nullable();
            $table->string('ubicacion')->nullable(); // formato lat,lng
            $table->enum('estado', ['pendiente', 'en proceso', 'resuelto'])->default('pendiente');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('zona_id')->references('id')->on('zonas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};

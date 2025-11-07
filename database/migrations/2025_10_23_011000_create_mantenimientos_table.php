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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id();
            $table->string('vehiculo'); // Identificación o nombre del vehículo
            $table->string('tipo_mantenimiento'); // Correctivo o preventivo
            $table->date('fecha'); // Fecha del mantenimiento
            $table->integer('kilometraje')->nullable(); // 👈 Campo que faltaba
            $table->decimal('costo_aproximado', 10, 2)->nullable(); // Costo estimado
            $table->string('responsable')->nullable(); // Persona a cargo
            $table->text('descripcion')->nullable(); // Detalle del mantenimiento
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};

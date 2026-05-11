<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cancelaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teson_id')->constrained()->onDelete('cascade');
            $table->integer('num_empleado');
            $table->string('nombre');
            $table->integer('numero_cheque');
            $table->decimal('importe', 12, 2);
            $table->tinyInteger('clave'); // códigos 50-81
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cancelaciones');
    }
};

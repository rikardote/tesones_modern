<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nominas', function (Blueprint $table) {
            $table->id();
            $table->string('nomina');
            $table->date('fecha_emision');
            $table->string('comentario')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nominas');
    }
};

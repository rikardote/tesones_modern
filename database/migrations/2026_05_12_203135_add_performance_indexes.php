<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Índices para consultas frecuentes en tesones
        Schema::table('tesons', function (Blueprint $table) {
            $table->index(['fecha_elaboracion'], 'tesons_fecha_elaboracion_index');
            // Índice compuesto para listados por usuario + fecha
            $table->index(['user_id', 'fecha_elaboracion'], 'tesons_user_fecha_index');
        });
    }

    public function down(): void
    {
        Schema::table('tesons', function (Blueprint $table) {
            $table->dropIndex('tesons_fecha_elaboracion_index');
            $table->dropIndex('tesons_user_fecha_index');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tesons', function (Blueprint $table) {
            $table->string('adscripcion_snapshot')->after('tipo_personal');
            $table->string('unidad_snapshot')->after('adscripcion_snapshot');
            $table->string('lugar_snapshot')->after('unidad_snapshot');
            $table->string('titular_area_snapshot')->after('lugar_snapshot')->nullable();
            $table->string('pagador_habilitado_snapshot')->after('titular_area_snapshot')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tesons', function (Blueprint $table) {
            $table->dropColumn([
                'adscripcion_snapshot',
                'unidad_snapshot',
                'lugar_snapshot',
                'titular_area_snapshot',
                'pagador_habilitado_snapshot'
            ]);
        });
    }
};

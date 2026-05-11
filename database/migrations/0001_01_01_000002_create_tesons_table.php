<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tesons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('nomina_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('remision_nomina'); // 1=BBVA, 2=Cheques, 3=Vales, 4=Pension, 5=FONAC DIE, 6=FONAC Debito, 7=SPEI
            $table->tinyInteger('tipo_personal'); // 1=Funcionario, 2=Operativo, 3=Honorarios, 4=Temporales
            $table->integer('folio_inicial')->nullable();
            $table->integer('folio_final')->nullable();
            $table->date('fecha_elaboracion');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tesons');
    }
};

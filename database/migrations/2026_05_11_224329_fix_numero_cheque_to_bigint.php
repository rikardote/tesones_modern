<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            // SQLite no soporta MODIFY, y los números grandes funcionan igual con INTEGER
            return;
        }
        DB::statement('ALTER TABLE cancelaciones MODIFY numero_cheque BIGINT NOT NULL');
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }
        DB::statement('ALTER TABLE cancelaciones MODIFY numero_cheque INT NOT NULL');
    }
};

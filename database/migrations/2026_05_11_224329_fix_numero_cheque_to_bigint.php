<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE cancelaciones MODIFY numero_cheque BIGINT NOT NULL');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE cancelaciones MODIFY numero_cheque INT NOT NULL');
    }
};

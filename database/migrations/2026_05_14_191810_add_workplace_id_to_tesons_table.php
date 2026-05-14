<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tesons', function (Blueprint $table) {
            $table->foreignId('workplace_id')->nullable()->after('user_id')->constrained()->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('tesons', function (Blueprint $table) {
            $table->dropForeign(['workplace_id']);
            $table->dropColumn('workplace_id');
        });
    }
};

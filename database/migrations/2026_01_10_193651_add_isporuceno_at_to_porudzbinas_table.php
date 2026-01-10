<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('porudzbinas', function (Blueprint $table) {
            $table->timestamp('isporuceno_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('porudzbinas', function (Blueprint $table) {
            $table->dropColumn('isporuceno_at');
        });
    }
};

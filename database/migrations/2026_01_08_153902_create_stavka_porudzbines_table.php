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
        Schema::disableForeignKeyConstraints();

        Schema::create('stavka_porudzbines', function (Blueprint $table) {
            $table->id();
            $table->string('table');
            $table->foreignId('porudzbina_id')->constrained();
            $table->foreignId('koktel_id')->constrained();
            $table->integer('kolicina')->default(1);
            $table->decimal('jedinicna_cena');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stavka_porudzbines');
    }
};

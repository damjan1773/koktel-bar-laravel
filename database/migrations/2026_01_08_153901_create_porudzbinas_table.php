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

        Schema::create('porudzbinas', function (Blueprint $table) {
            $table->id();
            $table->string('table');
            $table->integer('broj_stola');
            $table->string('status')->default('created');
            $table->text('napomena')->nullable();
            $table->foreignId('korisnik_id')->constrained('users');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('porudzbinas');
    }
};

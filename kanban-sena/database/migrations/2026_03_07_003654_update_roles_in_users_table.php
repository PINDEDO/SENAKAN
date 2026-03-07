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
        Schema::table('users', function (Blueprint $table) {
            // In MySQL, changing an enum requires raw SQL or re-defining the column
            // We'll use string for better flexibility or re-declare enum
            $table->enum('role', ['admin', 'coordinador', 'instructor', 'funcionario'])
                ->default('funcionario')
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'coordinador', 'instructor', 'aprendiz'])
                ->default('aprendiz')
                ->change();
        });
    }
};

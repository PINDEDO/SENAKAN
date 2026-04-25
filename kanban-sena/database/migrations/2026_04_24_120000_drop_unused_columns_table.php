<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * La tabla columns no se usaba en la aplicación y tenía un índice único incorrecto en status.
     */
    public function up(): void
    {
        Schema::dropIfExists('columns');
    }

    public function down(): void
    {
        Schema::create('columns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status');
            $table->integer('order')->default(0);
            $table->foreignId('project_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->unique(['project_id', 'status']);
        });
    }
};

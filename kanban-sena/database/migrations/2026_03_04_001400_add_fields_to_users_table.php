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
            $table->enum('role', ['admin', 'coordinador', 'instructor', 'aprendiz'])->default('aprendiz')->after('password');
            $table->unsignedBigInteger('center_id')->nullable()->after('role');
            $table->string('avatar')->nullable()->after('center_id');
            $table->boolean('active')->default(true)->after('avatar');
            $table->timestamp('last_login')->nullable()->after('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'center_id', 'avatar', 'active', 'last_login']);
        });
    }
};

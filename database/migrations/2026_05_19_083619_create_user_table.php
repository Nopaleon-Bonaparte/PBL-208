<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user', function (Blueprint $table) {
            $table->string('id_user', 10)->primary();
            $table->string('username', 100);
            $table->string('password', 255);
            $table->string('id_role', 10)->nullable();
            $table->string('id_ranting', 10)->nullable();
            $table->foreign('id_role')->references('id_role')->on('role');
            $table->foreign('id_ranting')->references('id_ranting')->on('ranting');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};

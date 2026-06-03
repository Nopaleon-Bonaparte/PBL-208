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
    Schema::dropIfExists('users');

    Schema::create('users', function (Blueprint $table) {
        $table->string('id_user', 10)->primary();

        $table->string('username', 50)->unique();
        $table->string('password', 255);

        $table->string('id_role', 10);
        $table->string('id_ranting', 10);

        $table->timestamps();

        $table->foreign('id_role')
              ->references('id_role')->on('master_role')
              ->onDelete('cascade');

        $table->foreign('id_ranting')
              ->references('id_ranting')->on('master_ranting')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_pbl');
    }
};

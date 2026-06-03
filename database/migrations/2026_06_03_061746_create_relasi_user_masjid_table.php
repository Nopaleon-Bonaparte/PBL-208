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
    Schema::create('relasi_user_masjid', function (Blueprint $table) {
        $table->string('id_user', 10);
        $table->string('id_masjid', 10);

        $table->timestamps();
        $table->primary(['id_user', 'id_masjid']);

        $table->foreign('id_user')
              ->references('id_user')->on('users')
              ->onDelete('cascade');

        $table->foreign('id_masjid')
              ->references('id_masjid')->on('masjid')
              ->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relasi_user_masjid');
    }
};

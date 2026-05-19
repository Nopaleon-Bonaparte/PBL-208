<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_masjid', function (Blueprint $table) {
            $table->string('id_user', 10);
            $table->string('id_masjid', 10);
            $table->primary(['id_user', 'id_masjid']);
            $table->foreign('id_user')->references('id_user')->on('user');
            $table->foreign('id_masjid')->references('id_masjid')->on('masjid');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('user_masjid');
    }
};

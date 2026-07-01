<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('privilege_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('id_role', 10);
            $table->enum('type', ['grant', 'revoke']);
            $table->text('message');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('privilege_notifications');
    }
};

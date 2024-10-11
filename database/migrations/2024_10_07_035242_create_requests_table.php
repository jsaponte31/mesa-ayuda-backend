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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('description', 255);
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('Usuario que realiza la solicitud');
            $table->foreignId('help_desk_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('Help Desk que atenderá la solicitud');
            $table->foreignId('status_request_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('Estado de la solicitud');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};

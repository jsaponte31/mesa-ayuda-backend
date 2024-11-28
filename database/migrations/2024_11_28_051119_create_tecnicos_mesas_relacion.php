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
        Schema::create('tecnicos_mesas_relacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tecnico_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('help_desk_id')->constrained('help_desks')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tecnicos_mesas_relacion');
    }
};

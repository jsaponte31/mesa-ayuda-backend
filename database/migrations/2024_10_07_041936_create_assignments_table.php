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
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained()->onDelete('cascade')->onUpdate('cascade')->comment('Solicitud de la tabla requests');
            $table->foreignId('technical_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade')->comment('Tecnico que gestiona la solicitud');
            $table->dateTime('date_assignment')->nullable();
            $table->dateTime('date_completion')->nullable();
            $table->string('technical_description',255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};

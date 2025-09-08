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
        Schema::create('organizaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ced_juridica')->unique();
            $table->string('nombre', 150);
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipos')->onDelete('cascade');
            $table->string('telefono', 150)->unique();
            $table->string('correo', 200)->unique();
            $table->string('urlPageWeb', 200)->nullable();
            $table->foreignId('provincia_id')->constrained('provincias');
            $table->decimal('ubi_Lat', 40, 30)->nullable();  // Decimal latitude
            $table->decimal('ubi_long', 40, 30)->nullable(); //Decimal longitude
            $table->string('urlDirectorioTelefonico', 200)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizaciones');
    }
};

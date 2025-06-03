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
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('apellido')->nullable();
            $table->string('apellido2')->nullable();
            $table->enum('sexo', ['f', 'm'])->default('f');
            $table->string('puesto')->nullable();
            $table->string('departamento')->nullable();
            $table->string('formacion')->nullable();
            $table->string('extension', 10)->nullable();
            $table->string('email_institucional')->unique();
            $table->string('email_personal')->nullable();
            $table->boolean('activo')->default(true);
            $table->string('nivel_contacto')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('id_municipalidad');
            $table->foreign('id_municipalidad')->references('id')->on('municipalidades')->onDelete('cascade');
            $table->unsignedBigInteger('id_institucion')->nullable();
            $table->foreign('id_institucion')->references('id')->on('instituciones')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactos');
    }
};

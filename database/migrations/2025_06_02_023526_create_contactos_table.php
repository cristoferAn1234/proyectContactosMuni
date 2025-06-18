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
            $table->string('nombre', 100);
            $table->string('apellido1', 150);
            $table->string('apellido2', 150);
            $table->string('sexo', 10);
            $table->string('puesto', 100);
            $table->unsignedBigInteger('puesto_id');
            $table->foreign('puesto_id')->references('id')->on('puestos')->onDelete('cascade');
            $table->string('departamento', 100);
            $table->string('formacion', 100);
            $table->string('extension', 100)->nullable();
            $table->string('email_institucional', 100)->unique();
            $table->string('email_personal', 100)->nullable();
            $table->unsignedBigInteger('organizacion_id');
            $table->foreign('organizacion_id')->references('id')->on('organizaciones')->onDelete('cascade');
            $table->boolean('activo');
            $table->string('nivel_contacto', 50);
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
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

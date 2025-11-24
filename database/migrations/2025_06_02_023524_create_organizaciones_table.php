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
                $table->foreign('tipo_id')->references('id')->on('tiposOrganizacion')->onDelete('cascade');
                $table->string('telefono', 150)->unique();
                $table->string('correo', 200)->unique();
                $table->string('urlPageWeb', 200)->nullable();
                $table->unsignedBigInteger('provincia_id');
                $table->foreign('provincia_id')->references('id')->on('provincias');
                $table->unsignedSmallInteger('canton_id');
                $table->foreign('canton_id')->references('id')->on('cantones');
                $table->unsignedBigInteger('distrito_id');
                $table->foreign('distrito_id')->references('id')->on('distritos');
                $table->decimal('ubi_Lat', 10, 8)->nullable();  // Decimal latitude
                $table->decimal('ubi_long', 11, 8)->nullable(); //Decimal longitude
                $table->string('urlDirectorioTelefonico', 200)->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
                $table->timestamps();
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

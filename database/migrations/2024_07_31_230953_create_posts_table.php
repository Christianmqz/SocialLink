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
        Schema::create('posts', function (Blueprint $table) {
            // Crea una columna de ID con 'auto_increment' (primary key)
            $table->id();
            // Crea una columna 'titulo' de tipo VARCHAR
            $table->string('titulo');
            // Crea una columna 'descripcion' de tipo TEXT
            $table->text('descripcion');
            // Crea una columna 'imagen' de tipo VARCHAR
            $table->string('imagen');
            // Crea una columna 'user_id' de tipo UNSIGNED BIGINT y agrega una llave foranea a la columna ID de la tabla USUARIOS
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

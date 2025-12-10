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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('titre');
            $table->string('categorie');
            $table->string('location');
            $table->text('description'); // Changé en text pour les longues descriptions
            $table->string('image')->nullable();
            $table->dateTime('date_debut'); // Ajout du champ date de début
            $table->dateTime('date_fin');
            $table->string('Cree_par');   // Ajout du champ date de fin
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};

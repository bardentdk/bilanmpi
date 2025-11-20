<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bilans', function (Blueprint $table) {
            $table->id();
            $table->string('stagiaire_nom');
            $table->string('stagiaire_prenom');
            $table->string('formation_titre');
            $table->date('formation_date_debut');
            $table->date('formation_date_fin');
            $table->text('objectifs_atteints')->nullable();
            $table->text('competences_acquises')->nullable();
            $table->text('points_forts')->nullable();
            $table->text('axes_amelioration')->nullable();
            $table->text('observations_generales')->nullable();
            $table->decimal('note_globale', 3, 1)->nullable();
            $table->json('original_data')->nullable();
            $table->json('rewritten_data')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bilans');
    }
};
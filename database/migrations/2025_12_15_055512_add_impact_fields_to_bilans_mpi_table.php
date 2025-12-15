<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bilans_mpi', function (Blueprint $table) {
            $table->string('impact_efficacite')->nullable()->after('bilan_genere');
            $table->string('impact_marche_travail')->nullable();
            $table->string('impact_insertion_sociale')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('bilans_mpi', function (Blueprint $table) {
            $table->dropColumn(['impact_efficacite', 'impact_marche_travail', 'impact_insertion_sociale']);
        });
    }
};
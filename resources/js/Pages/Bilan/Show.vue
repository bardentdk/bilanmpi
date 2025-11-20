
<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    bilan: Object
});

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
};
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="mb-8 flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">
                            Bilan de Formation Généré
                        </h1>
                        <p class="text-gray-600">
                            Réécrit automatiquement par l'IA Groq
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <Link
                            :href="route('bilans.create')"
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition"
                        >
                            Nouveau bilan
                        </Link>
                        <a
                            :href="route('bilans.pdf', bilan.id)"
                            class="px-4 py-2 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-lg hover:from-red-700 hover:to-pink-700 transition"
                        >
                            📄 Télécharger PDF
                        </a>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Informations Stagiaire -->
                    <div class="bg-blue-50 rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">
                            Informations du Stagiaire
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Nom complet</p>
                                <p class="text-lg font-medium">
                                    {{ bilan.stagiaire_prenom }} {{ bilan.stagiaire_nom }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Formation</p>
                                <p class="text-lg font-medium">{{ bilan.formation_titre }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Période</p>
                                <p class="text-lg font-medium">
                                    {{ formatDate(bilan.formation_date_debut) }} - {{ formatDate(bilan.formation_date_fin) }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Note globale</p>
                                <p class="text-2xl font-bold text-indigo-600">
                                    {{ bilan.note_globale }}/20
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Objectifs atteints -->
                    <div class="bg-green-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            Objectifs atteints
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ bilan.objectifs_atteints }}
                        </p>
                    </div>

                    <!-- Compétences acquises -->
                    <div class="bg-purple-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            Compétences acquises
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ bilan.competences_acquises }}
                        </p>
                    </div>

                    <!-- Points forts -->
                    <div class="bg-yellow-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            Points forts
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ bilan.points_forts }}
                        </p>
                    </div>

                    <!-- Axes d'amélioration -->
                    <div class="bg-orange-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            Axes d'amélioration
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ bilan.axes_amelioration }}
                        </p>
                    </div>

                    <!-- Observations générales -->
                    <div v-if="bilan.observations_generales" class="bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">
                            Observations générales
                        </h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ bilan.observations_generales }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    stagiaire_nom: '',
    stagiaire_prenom: '',
    formation_titre: '',
    formation_date_debut: '',
    formation_date_fin: '',
    objectifs_atteints: '',
    competences_acquises: '',
    points_forts: '',
    axes_amelioration: '',
    observations_generales: '',
    note_globale: '',
});

const submit = () => {
    form.post(route('bilans.store'));
};
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        Bilan de Formation
                    </h1>
                    <p class="text-gray-600">
                        Remplissez ce formulaire pour générer un bilan professionnel avec l'IA
                    </p>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <!-- Informations Stagiaire -->
                    <div class="bg-blue-50 rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">
                            Informations du Stagiaire
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nom
                                </label>
                                <input
                                    v-model="form.stagiaire_nom"
                                    type="text"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                />
                                <div v-if="form.errors.stagiaire_nom" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.stagiaire_nom }}
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Prénom
                                </label>
                                <input
                                    v-model="form.stagiaire_prenom"
                                    type="text"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                />
                                <div v-if="form.errors.stagiaire_prenom" class="text-red-500 text-sm mt-1">
                                    {{ form.errors.stagiaire_prenom }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations Formation -->
                    <div class="bg-green-50 rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">
                            Informations de la Formation
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Titre de la formation
                                </label>
                                <input
                                    v-model="form.formation_titre"
                                    type="text"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                />
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Date de début
                                    </label>
                                    <input
                                        v-model="form.formation_date_debut"
                                        type="date"
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Date de fin
                                    </label>
                                    <input
                                        v-model="form.formation_date_fin"
                                        type="date"
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Évaluation -->
                    <div class="bg-purple-50 rounded-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">
                            Évaluation
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Objectifs atteints
                                </label>
                                <textarea
                                    v-model="form.objectifs_atteints"
                                    required
                                    rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    placeholder="Décrivez les objectifs atteints..."
                                ></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Compétences acquises
                                </label>
                                <textarea
                                    v-model="form.competences_acquises"
                                    required
                                    rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    placeholder="Listez les compétences acquises..."
                                ></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Points forts
                                </label>
                                <textarea
                                    v-model="form.points_forts"
                                    required
                                    rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    placeholder="Identifiez les points forts..."
                                ></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Axes d'amélioration
                                </label>
                                <textarea
                                    v-model="form.axes_amelioration"
                                    required
                                    rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    placeholder="Suggérez des axes d'amélioration..."
                                ></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Observations générales (optionnel)
                                </label>
                                <textarea
                                    v-model="form.observations_generales"
                                    rows="3"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                    placeholder="Ajoutez des observations..."
                                ></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Note globale /20
                                </label>
                                <input
                                    v-model="form.note_globale"
                                    type="number"
                                    step="0.5"
                                    min="0"
                                    max="20"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                        >
                            <span v-if="form.processing">Génération en cours...</span>
                            <span v-else>Générer le bilan avec l'IA</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
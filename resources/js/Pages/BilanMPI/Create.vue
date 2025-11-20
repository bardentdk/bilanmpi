<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    nom: '',
    prenom: '',
    cip: '',
    formateurs: 'Benjamin SINAMA, Ansoitti Ali, Stéphanie PAYET, Christine CORRAL',
    notes_brutes: '',
});

const submit = () => {
    form.post(route('bilans-mpi.store'));
};
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">
                            Bilan MPI - Phase 1
                        </h1>
                        <p class="text-gray-600">
                            Dispositif Mobilisation vers la Professionnalisation et l'Insertion
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            Australe Formation CFA - La Réunion
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire -->
            <form @submit.prevent="submit" class="space-y-6">
                <!-- Informations Apprenant -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-5">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">
                            Informations de l'Apprenant
                        </h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nom <span class="text-red-500">*</span>
                            </label>
                            <input
                                v-model="form.nom"
                                type="text"
                                required
                                placeholder="Ex: TAMBON"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            />
                            <div v-if="form.errors.nom" class="text-red-500 text-sm mt-1">
                                {{ form.errors.nom }}
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Prénom <span class="text-red-500">*</span>
                            </label>
                            <input
                                v-model="form.prenom"
                                type="text"
                                required
                                placeholder="Ex: Djbarlen"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            />
                            <div v-if="form.errors.prenom" class="text-red-500 text-sm mt-1">
                                {{ form.errors.prenom }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations CIP et Formateurs -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-5">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">
                            Équipe Pédagogique
                        </h2>
                    </div>
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                CIP (Conseiller en Insertion Professionnelle) <span class="text-red-500">*</span>
                            </label>
                            <input
                                v-model="form.cip"
                                type="text"
                                required
                                placeholder="Ex: Jean MARTIN"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            />
                            <div v-if="form.errors.cip" class="text-red-500 text-sm mt-1">
                                {{ form.errors.cip }}
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Formateurs <span class="text-red-500">*</span>
                            </label>
                            <textarea
                                v-model="form.formateurs"
                                required
                                rows="2"
                                placeholder="Listez les formateurs (séparés par des virgules)"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                            ></textarea>
                            <p class="text-xs text-gray-500 mt-1">
                                Ex: Benjamin SINAMA, Ansoitti Ali, Stéphanie PAYET
                            </p>
                            <div v-if="form.errors.formateurs" class="text-red-500 text-sm mt-1">
                                {{ form.errors.formateurs }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes Brutes -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-5">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800">
                            Notes Brutes du CIP
                        </h2>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Saisissez vos observations en style libre <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            v-model="form.notes_brutes"
                            required
                            rows="15"
                            placeholder="Exemple de notes :

Parcours : Objectif devenir agent d'accueil. Freins : peu de confiance. Évolution positive avec accompagnement individualisé.

Conditions : Assiduité correcte sauf 2 absences justifiées. Engagement satisfaisant.

Méthodes : Ateliers participatifs + mise en situation réelle.

Module 1 Français : Difficultés orthographe début. Bonne progression. Degré : moyen
Module 2 Numérique : Très bon niveau, aide camarades. Degré : très bon
Module 3 Bureautique : Apprentissage Word et Excel. Objectifs atteints. Degré : bon
...

(Continuez pour tous les modules concernés)

Arrêt : Aucun"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition font-mono text-sm"
                        ></textarea>
                        <div class="mt-2 p-3 bg-purple-50 rounded-lg">
                            <p class="text-sm text-purple-800">
                                <strong>💡 Conseil :</strong> Écrivez librement vos observations. L'IA reformulera automatiquement en style professionnel :
                            </p>
                            <ul class="text-xs text-purple-700 mt-2 ml-4 space-y-1">
                                <li>✓ Style télégraphique accepté</li>
                                <li>✓ Abréviations comprises</li>
                                <li>✓ Notes désorganisées OK</li>
                                <li>✓ Minimum 50 caractères requis</li>
                            </ul>
                        </div>
                        <div v-if="form.errors.notes_brutes" class="text-red-500 text-sm mt-1">
                            {{ form.errors.notes_brutes }}
                        </div>
                    </div>
                </div>

                <!-- Bouton de soumission -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            <p class="font-medium">⚡ Génération automatique avec IA Groq</p>
                            <p class="text-xs">Le bilan sera structuré en format professionnel CIP</p>
                        </div>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 transform hover:scale-105"
                        >
                            <span v-if="form.processing" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Génération en cours...
                            </span>
                            <span v-else class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                                Générer le bilan MPI
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Message d'erreur global -->
                <div v-if="form.errors.error" class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                {{ form.errors.error }}
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    bilan: Object
});

const form = useForm({
    nom_apprenant: props.bilan.bilan_genere['Nom de l\'apprenant'],
    formateurs: props.bilan.bilan_genere.Formateurs,
    parcours: props.bilan.bilan_genere.Parcours,
    conditions: props.bilan.bilan_genere.Conditions,
    methodes: props.bilan.bilan_genere.Méthodes,
    module_1: props.bilan.bilan_genere['Module 1'],
    module_2: props.bilan.bilan_genere['Module 2'],
    module_3: props.bilan.bilan_genere['Module 3'],
    module_4: props.bilan.bilan_genere['Module 4'],
    module_5: props.bilan.bilan_genere['Module 5'],
    module_6: props.bilan.bilan_genere['Module 6'],
    module_7: props.bilan.bilan_genere['Module 7'],
    module_8: props.bilan.bilan_genere['Module 8'],
    module_9: props.bilan.bilan_genere['Module 9'],
    module_10: props.bilan.bilan_genere['Module 10'],
    module_11: props.bilan.bilan_genere['Module 11'],
    module_12: props.bilan.bilan_genere['Module 12'],
    module_13: props.bilan.bilan_genere['Module 13'],
    arret: props.bilan.bilan_genere.Arrêt,
});

const moduleLabels = [
    { key: 'module_1', label: 'MODULE 1 - Estime de soi et confiance en soi' },
    { key: 'module_2', label: 'MODULE 2 - Exprimer ses rêves et ses ambitions par le Dessin' },
    { key: 'module_3', label: 'MODULE 3 - Interculturalité' },
    { key: 'module_4', label: 'MODULE 4 - Se Libérer de ses addictions' },
    { key: 'module_5', label: 'MODULE 5 - Accompagnement Personnalisé Handicap' },
    { key: 'module_6', label: 'MODULE 6 - Apprentissage du Français, de la lecture et de l\'écriture' },
    { key: 'module_7', label: 'MODULE 7 - Remise à Niveau Numérique' },
    { key: 'module_8', label: 'MODULE 8 - Apprendre la posture professionnelle et s\'apprêter pour celle-ci' },
    { key: 'module_9', label: 'MODULE 9 - CLEA' },
    { key: 'module_10', label: 'MODULE 10 - CLEA Numérique' },
    { key: 'module_11', label: 'MODULE 11 - Lever ses freins liés à la Mobilité' },
    { key: 'module_12', label: 'MODULE 12 - Accompagnement personnalisé à l\'Insertion Socio-Pro' },
    { key: 'module_13', label: 'MODULE 13 - Accompagnement à la recherche d\'une entreprise ou d\'un CFA + Stage' },
];

const submit = () => {
    form.put(route('bilans-mpi.update', props.bilan.id));
};
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">
                            Modifier le Bilan MPI Phase 1
                        </h1>
                        <p class="text-gray-600">
                            {{ bilan.bilan_genere['Nom de l\'apprenant'] }} • CIP : {{ bilan.cip }}
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <form @submit.prevent="submit" class="space-y-6">
                <!-- Nom de l'apprenant -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Nom de l'apprenant
                    </label>
                    <input
                        v-model="form.nom_apprenant"
                        type="text"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    />
                </div>

                <!-- Formateurs -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Formateurs
                    </label>
                    <textarea
                        v-model="form.formateurs"
                        required
                        rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    ></textarea>
                </div>

                <!-- Parcours -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Parcours
                    </label>
                    <textarea
                        v-model="form.parcours"
                        required
                        rows="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    ></textarea>
                </div>

                <!-- Conditions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Conditions
                    </label>
                    <textarea
                        v-model="form.conditions"
                        required
                        rows="5"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    ></textarea>
                </div>

                <!-- Méthodes -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Méthodes Pédagogiques
                    </label>
                    <textarea
                        v-model="form.methodes"
                        required
                        rows="5"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                    ></textarea>
                </div>

                <!-- Modules -->
                <div class="bg-white rounded-xl shadow-xl p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Modules de Formation</h2>
                    </div>

                    <div class="space-y-6">
                        <div v-for="(module, index) in moduleLabels" :key="module.key" class="border-l-4 border-indigo-400 pl-4">
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                {{ module.label }}
                            </label>
                            <textarea
                                v-model="form[module.key]"
                                required
                                rows="8"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            ></textarea>
                        </div>
                    </div>
                </div>

                <!-- Arrêt -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Arrêt ou Interruption
                    </label>
                    <textarea
                        v-model="form.arret"
                        required
                        rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"
                    ></textarea>
                </div>

                <!-- Boutons d'action -->
                <div class="bg-white rounded-xl shadow-lg p-6 sticky bottom-0 ">
                    <div class="flex items-center justify-between">
                        <a
                            :href="route('bilans-mpi.show', bilan.id)"
                            class="px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition"
                        >
                            Annuler
                        </a>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                        >
                            <span v-if="form.processing">Enregistrement...</span>
                            <span v-else>Enregistrer les modifications</span>
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
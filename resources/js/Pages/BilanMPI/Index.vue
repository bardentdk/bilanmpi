<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    bilans: Object
});

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">
                            Bilans MPI Phase 1
                        </h1>
                        <p class="text-gray-600">
                            Dispositif Mobilisation vers la Professionnalisation et l'Insertion
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ bilans.total }} bilan(s) généré(s) • Australe Formation CFA
                        </p>
                    </div>
                    <Link
                        :href="route('bilans-mpi.create')"
                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 flex items-center"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Nouveau Bilan
                    </Link>
                </div>
            </div>

            <!-- Liste des bilans -->
            <div v-if="bilans.data.length > 0" class="space-y-4">
                <div 
                    v-for="bilan in bilans.data" 
                    :key="bilan.id"
                    class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-200 overflow-hidden"
                >
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-4">
                                        <span class="text-white font-bold text-lg">
                                            {{ bilan.prenom.charAt(0) }}{{ bilan.nom.charAt(0) }}
                                        </span>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">
                                            {{ bilan.bilan_genere['Nom de l\'apprenant'] }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            CIP : {{ bilan.cip }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="mt-3 flex flex-wrap gap-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ formatDate(bilan.created_at) }}
                                    </span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Bilan généré
                                    </span>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-2">
                                <Link
                                    :href="route('bilans-mpi.show', bilan.id)"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center justify-center"
                                >
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Voir
                                </Link>
                                <a
                                    :href="route('bilans-mpi.pdf', bilan.id)"
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center justify-center"
                                >
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Message si aucun bilan -->
            <div v-else class="bg-white rounded-xl shadow-lg p-12 text-center">
                <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">
                    Aucun bilan MPI généré
                </h3>
                <p class="text-gray-500 mb-6">
                    Commencez par créer votre premier bilan de Phase 1
                </p>
                <Link
                    :href="route('bilans-mpi.create')"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:from-blue-700 hover:to-indigo-700 transition-all"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Créer un bilan
                </Link>
            </div>

            <!-- Pagination -->
            <div v-if="bilans.last_page > 1" class="mt-6 bg-white rounded-xl shadow-lg p-4">
                <div class="flex items-center justify-between">
                    <Link
                        v-if="bilans.prev_page_url"
                        :href="bilans.prev_page_url"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition"
                    >
                        ← Précédent
                    </Link>
                    <span class="text-sm text-gray-600">
                        Page {{ bilans.current_page }} sur {{ bilans.last_page }}
                    </span>
                    <Link
                        v-if="bilans.next_page_url"
                        :href="bilans.next_page_url"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition"
                    >
                        Suivant →
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
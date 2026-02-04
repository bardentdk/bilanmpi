<script setup>
import { Link, router } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { debounce } from 'lodash';

const props = defineProps({
    bilans: Object,
    filters: Object,
});

const search = ref(props.filters.search || '');
const isExporting = ref(false);

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};

const performSearch = debounce(() => {
    router.get(route('bilans-mpi.index'), { search: search.value }, {
        preserveState: true,
        preserveScroll: true,
    });
}, 300);

watch(search, () => {
    performSearch();
});

const clearSearch = () => {
    search.value = '';
};

const exportAllPdf = () => {
    if (isExporting.value) return;
    
    const count = props.bilans.total;
    const message = search.value 
        ? `Vous allez télécharger ${count} bilan(s) correspondant à votre recherche.`
        : `Vous allez télécharger TOUS les ${count} bilans.`;
    
    if (!confirm(message + '\n\nContinuer ?')) {
        return;
    }
    
    isExporting.value = true;
    
    // Construire l'URL avec la recherche si elle existe
    const url = route('bilans-mpi.export.all') + (search.value ? `?search=${search.value}` : '');
    
    // Ouvrir dans un nouvel onglet pour le téléchargement
    window.location.href = url;
    
    // Réactiver le bouton après 3 secondes
    setTimeout(() => {
        isExporting.value = false;
    }, 3000);
};
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">
                            Bilans MPI Phase 1
                        </h1>
                        <p class="text-gray-600">
                            Dispositif Mobilisation vers la Professionnalisation et l'Insertion
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ bilans.total }} bilan(s) • Australe Formation CFA
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <!-- Bouton Export en masse -->
                        <button
                            v-if="bilans.total > 0"
                            @click="exportAllPdf"
                            :disabled="isExporting"
                            class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-semibold rounded-lg shadow-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-200 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                            <svg v-if="!isExporting" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            <svg v-else class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span v-if="!isExporting">Tout exporter (ZIP)</span>
                            <span v-else>Export en cours...</span>
                        </button>

                        <!-- Bouton Nouveau Bilan -->
                        <Link
                            :href="route('bilans-mpi.create')"
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 flex items-center justify-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Nouveau Bilan
                        </Link>
                    </div>
                </div>

                <!-- Barre de recherche -->
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input
                            v-model="search"
                            type="text"
                            placeholder="Rechercher par nom, prénom ou CIP..."
                            class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        />
                        <button
                            v-if="search"
                            @click="clearSearch"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                        >
                            <svg class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Indicateur de résultats -->
                    <div v-if="search" class="mt-2 text-sm text-gray-600">
                        <span v-if="bilans.total > 0">
                            {{ bilans.total }} résultat(s) pour "<strong>{{ search }}</strong>"
                        </span>
                        <span v-else class="text-orange-600">
                            Aucun résultat pour "<strong>{{ search }}</strong>"
                        </span>
                    </div>
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
                    {{ search ? 'Aucun résultat trouvé' : 'Aucun bilan MPI généré' }}
                </h3>
                <p class="text-gray-500 mb-6">
                    {{ search ? 'Essayez avec d\'autres termes de recherche' : 'Commencez par créer votre premier bilan de Phase 1' }}
                </p>
                <Link
                    v-if="!search"
                    :href="route('bilans-mpi.create')"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:from-blue-700 hover:to-indigo-700 transition-all"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Créer un bilan
                </Link>
                <button
                    v-else
                    @click="clearSearch"
                    class="inline-flex items-center px-6 py-3 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition-all"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Effacer la recherche
                </button>
            </div>

            <!-- Pagination -->
            <div v-if="bilans.last_page > 1" class="mt-6 bg-white rounded-xl shadow-lg p-4">
                <div class="flex items-center justify-between">
                    <Link
                        v-if="bilans.prev_page_url"
                        :href="bilans.prev_page_url"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition flex items-center"
                    >
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Précédent
                    </Link>
                    <span class="text-sm text-gray-600">
                        Page {{ bilans.current_page }} sur {{ bilans.last_page }}
                    </span>
                    <Link
                        v-if="bilans.next_page_url"
                        :href="bilans.next_page_url"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition flex items-center"
                    >
                        Suivant
                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
import { Link, usePage, router  } from '@inertiajs/vue3';
import { computed } from 'vue';


const props = defineProps({
    bilan: Object
});

const deleteBilan = () => {
    if (confirm('Êtes-vous sûr de vouloir supprimer ce bilan ? Cette action est irréversible.')) {
        router.delete(`/bilans-mpi/${props.bilan.id}`, {
            onSuccess: () => {
                // Redirection automatique vers la liste (géré par le contrôleur)
            },
            onError: (errors) => {
                alert('Erreur lors de la suppression : ' + Object.values(errors).join(', '))
            }
        })
    }
}

const page = usePage();
const successMessage = computed(() => page.props.flash?.success);

// Noms complets des modules depuis le template PDF
const moduleLabels = {
    'Module 1': 'MODULE 1 - Estime de soi et confiance en soi',
    'Module 2': 'MODULE 2 - Exprimer ses rêves et ses ambitions par le Dessin',
    'Module 3': 'MODULE 3 - Interculturalité',
    'Module 4': 'MODULE 4 - Se Libérer de ses addictions',
    'Module 5': 'MODULE 5 - Accompagnement Personnalisé Handicap',
    'Module 6': 'MODULE 6 - Apprentissage du Français, de la lecture et de l\'écriture',
    'Module 7': 'MODULE 7 - Remise à Niveau Numérique',
    'Module 8': 'MODULE 8 - Apprendre la posture professionnelle et s\'apprêter pour celle-ci',
    'Module 9': 'MODULE 9 - CLEA',
    'Module 10': 'MODULE 10 - CLEA Numérique',
    'Module 11': 'MODULE 11 - Lever ses freins liés à la Mobilité',
    'Module 12': 'MODULE 12 - Accompagnement personnalisé à l\'Insertion Socio-Pro',
    'Module 13': 'MODULE 13 - Accompagnement à la recherche d\'une entreprise ou d\'un CFA + Stage',
};

const getModuleColor = (index) => {
    const colors = [
        'bg-blue-50 border-blue-200',
        'bg-green-50 border-green-200',
        'bg-purple-50 border-purple-200',
        'bg-yellow-50 border-yellow-200',
        'bg-pink-50 border-pink-200',
        'bg-indigo-50 border-indigo-200',
        'bg-red-50 border-red-200',
        'bg-teal-50 border-teal-200',
        'bg-orange-50 border-orange-200',
        'bg-cyan-50 border-cyan-200',
        'bg-lime-50 border-lime-200',
        'bg-fuchsia-50 border-fuchsia-200',
        'bg-rose-50 border-rose-200',
    ];
    return colors[index % colors.length];
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('fr-FR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};
</script>

<template>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <!-- Message de succès -->
            <div v-if="successMessage" class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700 font-medium">
                            {{ successMessage }}
                        </p>
                    </div>
                </div>
            </div>
            <!-- Header avec actions -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-6 sticky top-0 w-full">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">
                            Bilan MPI Phase 1 - {{ bilan.bilan_genere['Nom de l\'apprenant'] }}
                        </h1>
                        <p class="text-gray-600">
                            CIP : {{ bilan.cip }} • Généré le {{ formatDate(bilan.created_at) }}
                        </p>
                    </div>
                    <!-- <div class="flex flex-wrap gap-3">
                        <Link
                            :href="route('bilans-mpi.index')"
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition flex items-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            Liste des bilans
                        </Link>
                        <Link
                            :href="route('bilans-mpi.create')"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Nouveau bilan
                        </Link>
                        <a
                            :href="route('bilans-mpi.pdf', bilan.id)"
                            class="px-4 py-2 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-lg hover:from-red-700 hover:to-pink-700 transition flex items-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Télécharger PDF
                        </a>
                    </div> -->
                    <div class="flex flex-wrap gap-3 text-sm">
                        <Link
                            :href="route('bilans-mpi.index')"
                            class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition flex items-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            Liste des bilans
                        </Link>
                        <Link
                            :href="route('bilans-mpi.edit', bilan.id)"
                            class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition flex items-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Modifier
                        </Link>
                        <Link
                            :href="route('bilans-mpi.create')"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Nouveau bilan
                        </Link>
                        <a
                            :href="route('bilans-mpi.pdf', bilan.id)"
                            class="px-4 py-2 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-lg hover:from-red-700 hover:to-pink-700 transition flex items-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Télécharger PDF
                        </a>
                        <!-- Nouveau bouton Supprimer -->
                        <button @click="deleteBilan"
                                class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>

            <!-- Informations générales -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Formateurs -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Formateurs</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        {{ bilan.bilan_genere.Formateurs }}
                    </p>
                </div>

                <!-- Parcours -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Parcours</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        {{ bilan.bilan_genere.Parcours }}
                    </p>
                </div>
            </div>

            <!-- Conditions et Méthodes -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Conditions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Conditions</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        {{ bilan.bilan_genere.Conditions }}
                    </p>
                </div>

                <!-- Méthodes -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">Méthodes Pédagogiques</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        {{ bilan.bilan_genere.Méthodes }}
                    </p>
                </div>
            </div>

            <!-- Modules -->
            <div class="bg-white rounded-xl shadow-xl p-6 mb-6">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800">Modules de Formation</h2>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <div 
                        v-for="(label, key, index) in moduleLabels" 
                        :key="key"
                        :class="['border-l-4 rounded-lg p-5 transition-all hover:shadow-md', getModuleColor(index)]"
                    >
                        <h4 class="font-semibold text-gray-800 mb-2 flex items-center">
                            <span class="inline-flex items-center justify-center w-6 h-6 bg-white rounded-full mr-2 text-xs font-bold">
                                {{ index + 1 }}
                            </span>
                            {{ label }}
                        </h4>
                        <p class="text-gray-700 leading-relaxed pl-8">
                            {{ bilan.bilan_genere[key] || 'Non renseigné' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Arrêt -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Arrêt ou Interruption</h3>
                </div>
                <p class="text-gray-700 leading-relaxed">
                    {{ bilan.bilan_genere.Arrêt }}
                </p>
            </div>

            <!-- Notes brutes (accordéon) -->
            <details class="bg-gray-50 rounded-xl shadow-lg p-6 mt-6">
                <summary class="cursor-pointer font-semibold text-gray-700 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Voir les notes brutes du CIP
                </summary>
                <div class="mt-4 p-4 bg-white rounded-lg border border-gray-200">
                    <pre class="whitespace-pre-wrap text-sm text-gray-600 font-mono">{{ bilan.notes_brutes }}</pre>
                </div>
            </details>
        </div>
    </div>
</template>
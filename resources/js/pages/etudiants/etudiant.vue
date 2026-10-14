
<script setup lang="ts">
import { Head, useForm, router } from '@inertiajs/vue3';

// 1. Récupération des étudiants envoyés par le contrôleur depuis MySQL
const props = defineProps<{
    etudiants: Array<{
        id: number;
        nom_complet: string;
        sexe: 'M' | 'F';
        niveau: number;
        created_at: string;
    }>;
}>();

// 2. Initialisation du formulaire avec useForm d'Inertia
const form = useForm({
    nom_complet: '',
    sexe: 'M' as 'M' | 'F',
    niveau: 1,
});

// 3. Soumission vers POST /etudiants
const submit = () => {
    form.post('/etudiants', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset('nom_complet');
        },
    });
};


</script>

<template>
    <div>
        <Head title="Gestion des Étudiants" />

    <div class="min-h-screen bg-slate-50 text-slate-800 py-10 px-4 sm:px-6 lg:px-8 font-sans">
        <div class="max-w-6xl mx-auto space-y-8">
            
            <!-- 1. En-tête -->
            <div class="text-center space-y-2">
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
                    Gestion des Étudiants & Générateur de Groupes
                </h1>
                <p class="text-slate-500 text-sm">
                    Formulaire réactif connecté à MySQL avec <span class="text-indigo-600 font-semibold font-mono">useForm</span>.
                </p>
            </div>

            <!-- 2. Badges de statistiques dynamiques -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm text-center">
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Étudiants</p>
                    <p class="text-2xl font-bold text-slate-800 mt-1">{{ etudiants.length }}</p>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm text-center">
                    <p class="text-xs font-semibold text-pink-500 uppercase tracking-wider">Filles</p>
                    <p class="text-2xl font-bold text-pink-600 mt-1">
                        {{ etudiants.filter(e => e.sexe === 'F').length }}
                    </p>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm text-center">
                    <p class="text-xs font-semibold text-indigo-500 uppercase tracking-wider">Garçons</p>
                    <p class="text-2xl font-bold text-indigo-600 mt-1">
                        {{ etudiants.filter(e => e.sexe === 'M').length }}
                    </p>
                </div>
                <div class="bg-white p-4 rounded-xl border border-slate-200 shadow-sm text-center">
                    <p class="text-xs font-semibold text-emerald-500 uppercase tracking-wider">Groupes Formés</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-1">0</p>
                </div>
            </div>

            <!-- 3. Formulaire (gauche) + Liste (droite) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Formulaire réactif avec useForm -->
                <div class="lg:col-span-4 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-5">
                    <div class="flex items-center gap-2 pb-3 border-b border-slate-100">
                        <span class="w-2.5 h-2.5 rounded-full bg-indigo-600"></span>
                        <h2 class="font-bold text-slate-800 text-lg">Ajouter un Étudiant</h2>
                    </div>

                    <form @submit.prevent="submit" class="space-y-4">
                        
                        <!-- Champ Nom Complet -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">
                                Nom complet
                            </label>
                            <input
                                v-model="form.nom_complet"
                                type="text"
                                placeholder="Ex: Fatou Ndiaye"
                                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                                :class="{ 'border-red-500 focus:ring-red-500': form.errors.nom_complet }"
                            />
                            <!-- Message d'erreur FormRequest -->
                            <p v-if="form.errors.nom_complet" class="text-red-500 text-xs mt-1 font-medium">
                                {{ form.errors.nom_complet }}
                            </p>
                        </div>

                        <!-- Sélecteur de Sexe -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">
                                Sexe
                            </label>
                            <div class="grid grid-cols-2 gap-2">
                                <button
                                    type="button"
                                    @click="form.sexe = 'M'"
                                    :class="form.sexe === 'M' ? 'border-indigo-500 bg-indigo-50 text-indigo-700 font-bold shadow-sm' : 'border-slate-200 text-slate-600 hover:bg-slate-50'"
                                    class="py-2.5 px-3 border rounded-xl text-sm transition flex items-center justify-center gap-2 cursor-pointer"
                                >
                                    <span>👨</span>
                                    <span>Garçon (M)</span>
                                </button>
                                <button
                                    type="button"
                                    @click="form.sexe = 'F'"
                                    :class="form.sexe === 'F' ? 'border-pink-500 bg-pink-50 text-pink-700 font-bold shadow-sm' : 'border-slate-200 text-slate-600 hover:bg-slate-50'"
                                    class="py-2.5 px-3 border rounded-xl text-sm transition flex items-center justify-center gap-2 cursor-pointer"
                                >
                                    <span>👩</span>
                                    <span>Fille (F)</span>
                                </button>
                            </div>
                            <p v-if="form.errors.sexe" class="text-red-500 text-xs mt-1 font-medium">
                                {{ form.errors.sexe }}
                            </p>
                        </div>

                        <!-- Sélecteur de Niveau -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">
                                Niveau d'études
                            </label>
                            <div class="grid grid-cols-3 gap-2">
                                <button
                                    v-for="niv in [1, 2, 3]"
                                    :key="niv"
                                    type="button"
                                    @click="form.niveau = niv"
                                    :class="form.niveau === niv ? 'border-slate-900 bg-slate-900 text-white font-bold shadow-sm' : 'border-slate-200 text-slate-600 hover:bg-slate-50'"
                                    class="py-2.5 border rounded-xl text-xs text-center cursor-pointer transition"
                                >
                                    Niveau {{ niv }}
                                </button>
                            </div>
                            <p v-if="form.errors.niveau" class="text-red-500 text-xs mt-1 font-medium">
                                {{ form.errors.niveau }}
                            </p>
                        </div>

                        <!-- Bouton Ajouter avec état de chargement -->
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="w-full mt-2 py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-sm transition text-sm flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50"
                        >
                            <span v-if="!form.processing">+</span>
                            <span>{{ form.processing ? 'Enregistrement en cours...' : 'Ajouter l’étudiant' }}</span>
                        </button>
                    </form>
                </div>

                <!-- Tableau Dynamique des Étudiants -->
                <div class="lg:col-span-8 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-4 border-b border-slate-100 gap-3">
                        <div>
                            <h2 class="font-bold text-slate-800 text-lg">Liste des Étudiants</h2>
                            <p class="text-xs text-slate-500">Données réelles enregistrées dans MySQL</p>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="text-xs text-slate-400 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-xl font-medium">
                                {{ etudiants.length }} inscrit(s)
                            </span>
                        </div>
                    </div>

                    <!-- Tableau dynamique -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead>
                                <tr class="text-slate-400 text-xs uppercase border-b border-slate-100">
                                    <th class="py-3 px-2 font-semibold">Nom complet</th>
                                    <th class="py-3 px-2 font-semibold">Sexe</th>
                                    <th class="py-3 px-2 font-semibold">Niveau</th>
                                    <th class="py-3 px-2 font-semibold">Groupe</th>
                                    <th class="py-3 px-2 font-semibold text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                
                                <tr v-for="e in etudiants" :key="e.id" class="hover:bg-slate-50 transition">
                                    <td class="py-3 px-2 font-medium text-slate-800 flex items-center gap-2">
                                        <div
                                            class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold"
                                            :class="e.sexe === 'F' ? 'bg-pink-100 text-pink-700' : 'bg-indigo-100 text-indigo-700'"
                                        >
                                            {{ e.nom_complet.charAt(0).toUpperCase() }}
                                        </div>
                                        <span>{{ e.nom_complet }}</span>
                                    </td>
                                    <td class="py-3 px-2">
                                        <span
                                            v-if="e.sexe === 'F'"
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-pink-50 text-pink-700 border border-pink-200"
                                        >
                                            Fille (F)
                                        </span>
                                        <span
                                            v-else
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-200"
                                        >
                                            Garçon (M)
                                        </span>
                                    </td>
                                    <td class="py-3 px-2">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold"
                                            :class="e.niveau === 1 ? 'bg-slate-100 text-slate-700 border border-slate-200' : (e.niveau === 2 ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-violet-50 text-violet-700 border border-violet-200')"
                                        >
                                            Niveau {{ e.niveau }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-2">
                                        <span class="text-xs font-medium text-slate-400 italic">
                                            Non assigné
                                        </span>
                                    </td>
                                    <td class="py-3 px-2 text-right">
                                        <button
                                            class="text-red-500 hover:text-red-700 text-xs font-medium cursor-pointer"
                                        >
                                            Supprimer
                                        </button>
                                    </td>
                                </tr>

                                <!-- État vide si aucun étudiant -->
                                <tr v-if="etudiants.length === 0">
                                    <td colspan="5" class="py-12 text-center text-slate-400 text-sm">
                                        <p class="font-medium text-slate-600 mb-1">Aucun étudiant dans la base de données.</p>
                                        <p class="text-xs text-slate-400">Remplissez le formulaire ci-contre pour ajouter votre premier étudiant !</p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
    </div>
</template>
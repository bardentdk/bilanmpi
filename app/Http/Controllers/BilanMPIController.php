<?php

namespace App\Http\Controllers;

use App\Models\BilanMPI;
use App\Services\GroqService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

class BilanMPIController extends Controller
{
    public function __construct(
        private GroqService $groqService
    ) {}

    /**
     * Afficher le formulaire
     */
    public function create()
    {
        return Inertia::render('BilanMPI/Create');
    }

    /**
     * Traiter le formulaire et générer le bilan
     */
    // public function store(Request $request)
    // {
    //     // Vérifier l'autorisation
    //     $this->authorize('create', BilanMPI::class);

    //     $validated = $request->validate([
    //         'nom' => 'required|string|max:255',
    //         'prenom' => 'required|string|max:255',
    //         'cip' => 'required|string|max:255',
    //         'formateurs' => 'required|string',
    //         'notes_brutes' => 'required|string|min:50',
    //     ]);

    //     try {
    //         // Générer le bilan avec l'IA Groq
    //         $bilanGenere = $this->groqService->generateBilanMPI($validated);

    //         // Créer le bilan en base de données avec l'user_id
    //         $bilan = BilanMPI::create([
    //             'nom' => $validated['nom'],
    //             'prenom' => $validated['prenom'],
    //             'cip' => $validated['cip'],
    //             'formateurs' => $validated['formateurs'],
    //             'notes_brutes' => $validated['notes_brutes'],
    //             'bilan_genere' => $bilanGenere,
    //             'user_id' => auth()->id(), // Associer le bilan à l'utilisateur connecté
    //         ]);

    //         return redirect()->route('bilans-mpi.show', $bilan->id)
    //             ->with('success', 'Bilan MPI Phase 1 généré avec succès !');

    //     } catch (\Exception $e) {
    //         return back()->withErrors([
    //             'error' => 'Erreur lors de la génération du bilan : ' . $e->getMessage()
    //         ])->withInput();
    //     }
    // }
    /**
     * Traiter le formulaire et générer le bilan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'cip' => 'required|string|max:255',
            'formateurs' => 'required|string',
            'notes_brutes' => 'required|string|min:50',
        ]);

        try {
            // Générer le bilan avec l'IA Groq
            $bilanGenere = $this->groqService->generateBilanMPI($validated);

            // Créer le bilan en base de données
            $bilan = BilanMPI::create([
                'nom' => $validated['nom'],
                'prenom' => $validated['prenom'],
                'cip' => $validated['cip'],
                'formateurs' => $validated['formateurs'],
                'notes_brutes' => $validated['notes_brutes'],
                'bilan_genere' => $bilanGenere,
            ]);

            return redirect()->route('bilans-mpi.show', $bilan->id)
                ->with('success', 'Bilan MPI Phase 1 généré avec succès !');

        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Erreur lors de la génération du bilan : ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Afficher le bilan généré
     */
    public function show(BilanMPI $bilanMpi)
    {
        // Vérifier l'autorisation
        // $this->authorize('view', $bilanMpi);

        return Inertia::render('BilanMPI/Show', [
            'bilan' => $bilanMpi
        ]);
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(BilanMPI $bilanMpi)
    {
        // Vérifier l'autorisation
        // $this->authorize('update', $bilanMpi);

        return Inertia::render('BilanMPI/Edit', [
            'bilan' => $bilanMpi
        ]);
    }

    /**
     * Mettre à jour le bilan v1
     */
    // public function update(Request $request, BilanMPI $bilanMpi)
    // {
    //     // Vérifier l'autorisation
    //     $this->authorize('update', $bilanMpi);

    //     $validated = $request->validate([
    //         'nom_apprenant' => 'required|string',
    //         'formateurs' => 'required|string',
    //         'parcours' => 'required|string',
    //         'conditions' => 'required|string',
    //         'methodes' => 'required|string',
    //         'module_1' => 'required|string',
    //         'module_2' => 'required|string',
    //         'module_3' => 'required|string',
    //         'module_4' => 'required|string',
    //         'module_5' => 'required|string',
    //         'module_6' => 'required|string',
    //         'module_7' => 'required|string',
    //         'module_8' => 'required|string',
    //         'module_9' => 'required|string',
    //         'module_10' => 'required|string',
    //         'module_11' => 'required|string',
    //         'module_12' => 'required|string',
    //         'module_13' => 'required|string',
    //         'arret' => 'required|string',
    //     ]);

    //     try {
    //         // Reconstruire le tableau bilan_genere avec les nouvelles données
    //         $bilanGenereUpdated = [
    //             'Nom de l\'apprenant' => $validated['nom_apprenant'],
    //             'Formateurs' => $validated['formateurs'],
    //             'Parcours' => $validated['parcours'],
    //             'Conditions' => $validated['conditions'],
    //             'Méthodes' => $validated['methodes'],
    //             'Module 1' => $validated['module_1'],
    //             'Module 2' => $validated['module_2'],
    //             'Module 3' => $validated['module_3'],
    //             'Module 4' => $validated['module_4'],
    //             'Module 5' => $validated['module_5'],
    //             'Module 6' => $validated['module_6'],
    //             'Module 7' => $validated['module_7'],
    //             'Module 8' => $validated['module_8'],
    //             'Module 9' => $validated['module_9'],
    //             'Module 10' => $validated['module_10'],
    //             'Module 11' => $validated['module_11'],
    //             'Module 12' => $validated['module_12'],
    //             'Module 13' => $validated['module_13'],
    //             'Arrêt' => $validated['arret'],
    //         ];

    //         $bilanMpi->update([
    //             'bilan_genere' => $bilanGenereUpdated,
    //         ]);

    //         return redirect()->route('bilans-mpi.show', $bilanMpi->id)
    //             ->with('success', 'Bilan modifié avec succès !');

    //     } catch (\Exception $e) {
    //         return back()->withErrors([
    //             'error' => 'Erreur lors de la modification du bilan : ' . $e->getMessage()
    //         ])->withInput();
    //     }
    // }

    /**
     * Mettre à jour le bilan
     */
    public function update(Request $request, BilanMPI $bilanMpi)
    {
        $validated = $request->validate([
            'nom_apprenant' => 'required|string',
            'formateurs' => 'required|string',
            'parcours' => 'required|string',
            'conditions' => 'required|string',
            'methodes' => 'required|string',
            'module_1' => 'required|string',
            'module_2' => 'required|string',
            'module_3' => 'required|string',
            'module_4' => 'required|string',
            'module_5' => 'required|string',
            'module_6' => 'required|string',
            'module_7' => 'required|string',
            'module_8' => 'required|string',
            'module_9' => 'required|string',
            'module_10' => 'required|string',
            'module_11' => 'required|string',
            'module_12' => 'required|string',
            'module_13' => 'required|string',
            'arret' => 'required|string',
            'impact_efficacite' => 'nullable|string|in:pas_du_tout,moyennement,beaucoup,au_dela',
            'impact_marche_travail' => 'nullable|string|in:pas_du_tout,moyennement,beaucoup,au_dela',
            'impact_insertion_sociale' => 'nullable|string|in:pas_du_tout,moyennement,beaucoup,au_dela',
        ]);

        try {
            // Reconstruire le tableau bilan_genere avec les nouvelles données
            $bilanGenereUpdated = [
                'Nom de l\'apprenant' => $validated['nom_apprenant'],
                'Formateurs' => $validated['formateurs'],
                'Parcours' => $validated['parcours'],
                'Conditions' => $validated['conditions'],
                'Méthodes' => $validated['methodes'],
                'Module 1' => $validated['module_1'],
                'Module 2' => $validated['module_2'],
                'Module 3' => $validated['module_3'],
                'Module 4' => $validated['module_4'],
                'Module 5' => $validated['module_5'],
                'Module 6' => $validated['module_6'],
                'Module 7' => $validated['module_7'],
                'Module 8' => $validated['module_8'],
                'Module 9' => $validated['module_9'],
                'Module 10' => $validated['module_10'],
                'Module 11' => $validated['module_11'],
                'Module 12' => $validated['module_12'],
                'Module 13' => $validated['module_13'],
                'Arrêt' => $validated['arret'],
            ];

            $bilanMpi->update([
                'bilan_genere' => $bilanGenereUpdated,
                'impact_efficacite' => $validated['impact_efficacite'] ?? null,
                'impact_marche_travail' => $validated['impact_marche_travail'] ?? null,
                'impact_insertion_sociale' => $validated['impact_insertion_sociale'] ?? null,
            ]);

            return redirect()->route('bilans-mpi.show', $bilanMpi->id)
                ->with('success', 'Bilan modifié avec succès !');

        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Erreur lors de la modification du bilan : ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Télécharger le PDF
     */
    
    // public function downloadPdf(BilanMPI $bilanMpi)
    // {
    //     // Vérifier l'autorisation
    //     // $this->authorize('view', $bilanMpi);

    //     $pdf = Pdf::loadView('pdf.bilan-mpi', ['bilan' => $bilanMpi])
    //         ->setPaper('a4', 'portrait');

    //     $filename = sprintf(
    //         'bilan_mpi_phase1_%s_%s_%s.pdf',
    //         strtolower($bilanMpi->nom),
    //         strtolower($bilanMpi->prenom),
    //         $bilanMpi->created_at->format('Y-m-d')
    //     );

    //     return $pdf->download($filename);
    // }
    public function downloadPdf(BilanMPI $bilanMpi)
    {
        $pdf = Pdf::loadView('pdf.bilan-mpi', ['bilan' => $bilanMpi])
            ->setPaper('a4', 'portrait');

        // Format: DFP/2023/0814 - Bilan - NOM PRENOM.pdf
        $filename = sprintf(
            'DFP-2023-0814 - Bilan - %s %s.pdf',
            strtoupper($bilanMpi->nom),      // NOM en majuscules
            ucfirst($bilanMpi->prenom)       // Prénom avec première lettre majuscule
        );

        return $pdf->download($filename);
    }

    /**
     * Liste des bilans
     */
    // public function index()
    // {
    //     // Admin voit tous les bilans, utilisateur standard voit uniquement les siens
    //     $query = BilanMPI::query();

    //     // if (!auth()->user()->isAdmin()) {
    //     //     $query->where('user_id', auth()->id());
    //     // }

    //     $bilans = $query->orderBy('created_at', 'desc')->paginate(20);

    //     return Inertia::render('BilanMPI/Index', [
    //         'bilans' => $bilans
    //     ]);
    // }
    /**
     * Liste des bilans avec recherche
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $bilans = BilanMPI::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nom', 'like', "%{$search}%")
                    ->orWhere('prenom', 'like', "%{$search}%")
                    ->orWhere('cip', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(nom, ' ', prenom) like ?", ["%{$search}%"])
                    ->orWhereRaw("CONCAT(prenom, ' ', nom) like ?", ["%{$search}%"]);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString(); // Important pour garder la recherche dans la pagination

        return Inertia::render('BilanMPI/Index', [
            'bilans' => $bilans,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }
    /**
     * Supprimer un bilan
     */
    public function destroy(BilanMPI $bilanMpi)
    {
        // Vérifier l'autorisation
        // $this->authorize('delete', $bilanMpi);

        try {
            $bilanMpi->delete();

            return redirect()->route('bilans-mpi.index')
                ->with('success', 'Bilan supprimé avec succès !');

        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Erreur lors de la suppression : ' . $e->getMessage()
            ]);
        }
    }
}
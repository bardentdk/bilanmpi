<?php

namespace App\Http\Controllers;

use App\Models\BilanMPI;
use App\Services\GroqService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive;

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
            $bilanGenere = $this->groqService->generateBilanMPI($validated);

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
        return Inertia::render('BilanMPI/Show', [
            'bilan' => $bilanMpi
        ]);
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(BilanMPI $bilanMpi)
    {
        return Inertia::render('BilanMPI/Edit', [
            'bilan' => $bilanMpi
        ]);
    }

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
     * Télécharger un PDF individuel
     */
    public function downloadPdf(BilanMPI $bilanMpi)
    {
        $pdf = Pdf::loadView('pdf.bilan-mpi', ['bilan' => $bilanMpi])
            ->setPaper('a4', 'portrait');

        $filename = sprintf(
            'DFP-2023-0814 - Bilan - %s %s.pdf',
            strtoupper($bilanMpi->nom),
            ucfirst($bilanMpi->prenom)
        );

        return $pdf->download($filename);
    }

    /**
     * Exporter les bilans sélectionnés en ZIP
     */
    public function exportSelectedPdf(Request $request)
    {
        set_time_limit(300);
        ini_set('memory_limit', '512M');
        
        // DEBUG : Log pour voir ce qui arrive
        \Log::info('Export request received', [
            'bilan_ids_count' => count($request->input('bilan_ids', [])),
            'bilan_ids' => $request->input('bilan_ids')
        ]);
        
        $validated = $request->validate([
            'bilan_ids' => 'required|array|min:1|max:50',
            'bilan_ids.*' => 'required|integer|exists:bilans_mpi,id',
        ]);
        
        \Log::info('After validation', [
            'validated_count' => count($validated['bilan_ids'])
        ]);
        
        $bilanIds = $validated['bilan_ids'];
        
        // Créer un dossier temporaire
        $tempPath = storage_path('app/temp');
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0755, true);
        }
        
        $zipFileName = 'bilans_mpi_selection_' . now()->format('Y-m-d_His') . '.zip';
        $zipFilePath = $tempPath . '/' . $zipFileName;
        
        $zip = new ZipArchive();
        
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            \Log::error('Cannot create ZIP file');
            return back()->with('error', 'Impossible de créer le fichier ZIP.');
        }
        
        try {
            $successCount = 0;
            
            foreach ($bilanIds as $index => $bilanId) {
                $bilan = BilanMPI::find($bilanId);
                
                if (!$bilan) {
                    \Log::warning("Bilan not found: {$bilanId}");
                    continue;
                }
                
                $pdf = Pdf::loadView('pdf.bilan-mpi', ['bilan' => $bilan])
                    ->setPaper('a4', 'portrait');
                
                $pdfFileName = sprintf(
                    'DFP-2023-0814 - Bilan - %s %s.pdf',
                    strtoupper($bilan->nom),
                    ucfirst($bilan->prenom)
                );
                
                $zip->addFromString($pdfFileName, $pdf->output());
                $successCount++;
                
                // Libérer la mémoire tous les 10 bilans
                if (($index + 1) % 10 === 0) {
                    gc_collect_cycles();
                }
            }
            
            $zip->close();
            
            \Log::info('Export completed', [
                'requested' => count($bilanIds),
                'successful' => $successCount,
                'zip_file' => $zipFilePath
            ]);
            
            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
            
        } catch (\Exception $e) {
            if ($zip) {
                $zip->close();
            }
            @unlink($zipFilePath);
            
            \Log::error('Export failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Erreur lors de la génération du ZIP : ' . $e->getMessage());
        }
    }

    /**
     * Liste des bilans avec recherche - PAGINATION 50
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
            ->paginate(50) // 50 bilans par page
            ->withQueryString();

        return Inertia::render('BilanMPI/Index', [
            'bilans' => $bilans,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }
}
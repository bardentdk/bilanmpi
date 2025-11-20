<?php

namespace App\Http\Controllers;

use App\Models\Bilan;
use App\Services\GroqService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;

class BilanController extends Controller
{
    public function __construct(
        private GroqService $groqService
    ) {}

    /**
     * Afficher le formulaire
     */
    public function create()
    {
        return Inertia::render('Bilan/Create');
    }

    /**
     * Traiter le formulaire et générer le bilan
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'stagiaire_nom' => 'required|string|max:255',
            'stagiaire_prenom' => 'required|string|max:255',
            'formation_titre' => 'required|string|max:255',
            'formation_date_debut' => 'required|date',
            'formation_date_fin' => 'required|date|after_or_equal:formation_date_debut',
            'objectifs_atteints' => 'required|string',
            'competences_acquises' => 'required|string',
            'points_forts' => 'required|string',
            'axes_amelioration' => 'required|string',
            'observations_generales' => 'nullable|string',
            'note_globale' => 'required|numeric|min:0|max:20',
        ]);

        try {
            // Préparer les données pour l'IA
            $textsToRewrite = [
                'objectifs_atteints' => $validated['objectifs_atteints'],
                'competences_acquises' => $validated['competences_acquises'],
                'points_forts' => $validated['points_forts'],
                'axes_amelioration' => $validated['axes_amelioration'],
                'observations_generales' => $validated['observations_generales'] ?? '',
            ];

            // Réécrire avec l'IA Groq
            $rewrittenData = $this->groqService->generateBilan($textsToRewrite);

            // Créer le bilan en base de données
            $bilan = Bilan::create([
                'stagiaire_nom' => $validated['stagiaire_nom'],
                'stagiaire_prenom' => $validated['stagiaire_prenom'],
                'formation_titre' => $validated['formation_titre'],
                'formation_date_debut' => $validated['formation_date_debut'],
                'formation_date_fin' => $validated['formation_date_fin'],
                'objectifs_atteints' => $rewrittenData['objectifs_atteints'],
                'competences_acquises' => $rewrittenData['competences_acquises'],
                'points_forts' => $rewrittenData['points_forts'],
                'axes_amelioration' => $rewrittenData['axes_amelioration'],
                'observations_generales' => $rewrittenData['observations_generales'],
                'note_globale' => $validated['note_globale'],
                'original_data' => $textsToRewrite,
                'rewritten_data' => $rewrittenData,
            ]);

            return redirect()->route('bilans.show', $bilan->id)
                ->with('success', 'Bilan généré avec succès !');

        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Erreur lors de la génération du bilan : ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Afficher le bilan généré
     */
    public function show(Bilan $bilan)
    {
        return Inertia::render('Bilan/Show', [
            'bilan' => $bilan
        ]);
    }

    /**
     * Télécharger le PDF
     */
    public function downloadPdf(Bilan $bilan)
    {
        $pdf = Pdf::loadView('pdf.bilan', ['bilan' => $bilan])
            ->setPaper('a4', 'portrait');

        $filename = sprintf(
            'bilan_%s_%s_%s.pdf',
            $bilan->stagiaire_nom,
            $bilan->stagiaire_prenom,
            $bilan->created_at->format('Y-m-d')
        );

        return $pdf->download($filename);
    }
}
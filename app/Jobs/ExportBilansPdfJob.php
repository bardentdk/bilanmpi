<?php

namespace App\Jobs;

use App\Models\BilanMPI;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ExportBilansPdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 600; // 10 minutes max
    
    protected $bilanIds;
    protected $userEmail;

    public function __construct(array $bilanIds, ?string $userEmail = null)
    {
        $this->bilanIds = $bilanIds;
        $this->userEmail = $userEmail;
    }

    public function handle(): void
    {
        $zipFileName = 'bilans_mpi_export_' . now()->format('Y-m-d_His') . '.zip';
        $zipFilePath = storage_path('app/temp/' . $zipFileName);
        
        $zip = new ZipArchive();
        
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new \Exception('Impossible de créer le fichier ZIP.');
        }
        
        foreach ($this->bilanIds as $bilanId) {
            $bilan = BilanMPI::find($bilanId);
            
            if (!$bilan) continue;
            
            $pdf = Pdf::loadView('pdf.bilan-mpi', ['bilan' => $bilan])
                ->setPaper('a4', 'portrait');
            
            $pdfFileName = sprintf(
                'DFP-2023-0814 - Bilan - %s %s.pdf',
                strtoupper($bilan->nom),
                ucfirst($bilan->prenom)
            );
            
            $zip->addFromString($pdfFileName, $pdf->output());
        }
        
        $zip->close();
        
        // Déplacer vers storage public
        $publicPath = 'exports/' . $zipFileName;
        Storage::disk('public')->put($publicPath, file_get_contents($zipFilePath));
        
        // Supprimer le fichier temporaire
        @unlink($zipFilePath);
        
        // TODO: Envoyer un email avec le lien de téléchargement
        // ou afficher une notification dans l'interface
    }
}
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\BilanMPISeeder;

class GenerateBilansMPI extends Command
{
    protected $signature = 'bilans:generate {count=100 : Nombre de bilans à générer}';
    protected $description = 'Génère des bilans MPI de test';

    public function handle()
    {
        $count = (int) $this->argument('count');
        
        if ($count < 1 || $count > 500) {
            $this->error('Le nombre doit être entre 1 et 500');
            return 1;
        }
        
        $this->info("Génération de {$count} bilans MPI...");
        
        $seeder = new BilanMPISeeder();
        $seeder->setCommand($this);
        $seeder->run();
        
        return 0;
    }
}
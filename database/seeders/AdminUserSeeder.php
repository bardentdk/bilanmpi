<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Créer le premier compte administrateur
     *
     * Exécuter avec: php artisan db:seed --class=AdminUserSeeder
     */
    public function run(): void
    {
        // Vérifier si un admin existe déjà
        if (User::where('role', 'admin')->exists()) {
            $this->command->info('Un compte administrateur existe déjà.');
            return;
        }

        // Créer le compte admin
        $admin = User::create([
            'name' => 'Administrateur',
            'email' => 'admin@australeformation.re',
            'password' => Hash::make('password'), // CHANGEZ CE MOT DE PASSE !
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->command->info('✓ Compte administrateur créé avec succès !');
        $this->command->info('');
        $this->command->warn('IMPORTANT : Changez le mot de passe par défaut !');
        $this->command->info('Email : ' . $admin->email);
        $this->command->info('Mot de passe : password');
        $this->command->info('');
        $this->command->info('Vous pouvez maintenant vous connecter et créer d\'autres utilisateurs.');
    }
}

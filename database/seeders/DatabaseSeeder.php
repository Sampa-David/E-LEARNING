<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * DATABASE SEEDER
 * Orchestre l'exécution de tous les seeders pour initialiser la base de données
 * 
 * Ordre d'exécution:
 * 1. RoleSeeder - Crée les rôles (student, teacher, superadmin)
 * 2. PermissionSeeder - Crée les permissions (view_courses, create_course, etc.)
 * 3. AssignPermissionsSeeder - Assigne les permissions aux rôles
 */
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * SEMER LA BASE DE DONNÉES
     * Exécute tous les seeders dans l'ordre approprié
     */
    public function run(): void
    {
        // ========== ÉTAPE 1: CRÉER LES RÔLES ==========
        // Doit être fait en premier car les autres seeders dépendent des rôles
        $this->call(RoleSeeder::class);

        // ========== ÉTAPE 2: CRÉER LES PERMISSIONS ==========
        // Doit être fait avant AssignPermissionsSeeder
        $this->call(PermissionSeeder::class);

        // ========== ÉTAPE 3: ASSIGNER LES PERMISSIONS AUX RÔLES ==========
        // Utilise les rôles et permissions créés ci-dessus
        $this->call(AssignPermissionsSeeder::class);

        // ========== ÉTAPE 4: CRÉER LES COURS ==========
        // Crée des cours de test pour les professeurs
        $this->call(CourseSeeder::class);

        // ========== ÉTAPE 5: CRÉER LES INSCRIPTIONS ==========
        // Crée des inscriptions d'étudiants aux cours
        $this->call(EnrollmentSeeder::class);

        // ========== ÉTAPE 6: CRÉER LES AVIS ==========
        // Crée des avis et évaluations pour les cours
        $this->call(ReviewSeeder::class);

        // ========== ÉTAPE 7 (OPTIONNEL): CRÉER UN UTILISATEUR DE TEST ==========
        // Créer un superadmin par défaut pour accéder au système
        User::factory()->create([
            'username' => 'admin',
            'name' => 'Admin',
            'surname' => 'System',
            'email' => 'admin@elearning.com',
            'password' => bcrypt('password'), // Mot de passe: "password"
            'role' => 'superadmin',
            'sexe' => 'masculin',
            'Birth_day' => '1990-01-01',
            'town' => 'Paris',
            'country' => 'France',
            'phone' => '+33 6 12 34 56 78',
        ]);

        // Créer un utilisateur étudiant de test
        User::factory()->create([
            'username' => 'student01',
            'name' => 'Jean',
            'surname' => 'Dupont',
            'email' => 'student@elearning.com',
            'password' => bcrypt('password'),
            'role' => 'student',
            'sexe' => 'masculin',
            'Birth_day' => '2000-05-15',
            'town' => 'Lyon',
            'country' => 'France',
            'phone' => '+33 6 98 76 54 32',
        ]);

        // Créer un utilisateur professeur de test
        User::factory()->create([
            'username' => 'teacher01',
            'name' => 'Marie',
            'surname' => 'Martin',
            'email' => 'teacher@elearning.com',
            'password' => bcrypt('password'),
            'role' => 'teacher',
            'sexe' => 'feminin',
            'Birth_day' => '1985-08-20',
            'town' => 'Marseille',
            'country' => 'France',
            'phone' => '+33 6 55 66 77 88',
        ]);
    }
}
